<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة جانبية</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
    <link rel="stylesheet" href="{{ asset('css/men.css') }}">

</head>
<body>
    <div class="sidebar">
        <button class="btn material-icons home idea">idea</button>
        <button class="btn material-icons favorite requirements">requirements</button>
        <button class="btn material-icons shopping_cart mistakes">mistakes</button>
        <button class="btn material-icons settings number">number</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.11/interact.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        let currentCard;
        let ideaCount = 0;
        let mistakesCount = 0;
        const projectId = '{{ $id }}'; // Asigna el valor de $id desde Laravel

        function dragStart(e) {
            currentCard = this;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', null);
        }

        function dragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }

        function drop(e) {
            e.preventDefault();
            const cardContainer = e.currentTarget;
            if (cardContainer !== currentCard) {
                cardContainer.parentNode.appendChild(currentCard);
                currentCard.style.zIndex = getHighestZIndex() + 1;
            }
        }

        function getHighestZIndex() {
            const cards = document.querySelectorAll('.card');
            let highestZIndex = 0;
            cards.forEach(card => {
                const zIndex = parseInt(window.getComputedStyle(card).zIndex);
                if (!isNaN(zIndex) && zIndex > highestZIndex) {
                    highestZIndex = zIndex;
                }
            });
            return highestZIndex;
        }

        function createCard(className, title, hasBadge = false) {
            const newElement = document.createElement('div');
            newElement.className = 'card ' + className;
            newElement.draggable = true;
            let badgeNumber;
            if (className === 'idea-card') {
                ideaCount++;
                badgeNumber = ideaCount;
            } else if (className === 'mistakes-card') {
                mistakesCount++;
                badgeNumber = mistakesCount;
            }
            if (hasBadge) {
                newElement.innerHTML = '<h2 class="card-title ' + className + '-title">' + title + '<span class="badge">' + badgeNumber + '</span></h2>';
            } else {
                newElement.innerHTML = '<h2 class="card-title ' + className + '-title">' + title + '</h2>';
            }

            document.body.appendChild(newElement);

            newElement.addEventListener('dragstart', dragStart);
            newElement.addEventListener('dragover', dragOver);
            newElement.addEventListener('drop', drop);
            newElement.addEventListener('dblclick', deleteCard);

            interact(newElement).draggable({
                inertia: true,
                modifiers: [
                    interact.modifiers.restrictRect({
                        restriction: 'parent',
                        endOnly: true
                    })
                ],
                autoScroll: true,
                onmove: dragMoveListener
            });

            function dragMoveListener(event) {
                const target = event.target;
                const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);

                updateCardPosition(target);
            }

            return newElement;
        }

        function deleteCard(event) {
            const card = event.currentTarget;
            if (card.classList.contains('idea-card')) {
                ideaCount--;
            } else if (card.classList.contains('mistakes-card')) {
                mistakesCount--;
            }
            const taskId = card.querySelector('.badge').textContent;

            axios.delete('/administration/public/tasks/' + taskId)
                .then(response => {
                    card.remove();
                })
                .catch(error => {
                    console.error('Error deleting card:', error);
                });
        }

        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('dragstart', dragStart);
            card.addEventListener('dragover', dragOver);
            card.addEventListener('drop', drop);
            card.addEventListener('dblclick', deleteCard);
            interact(card).draggable({
                inertia: true,
                modifiers: [
                    interact.modifiers.restrictRect({
                        restriction: 'parent',
                        endOnly: true
                    })
                ],
                autoScroll: true,
                onmove: dragMoveListener
            });
        });

        interact('.card').draggable({
            inertia: true,
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: 'parent',
                    endOnly: true
                })
            ],
            autoScroll: true,
            onmove: dragMoveListener
        });

        document.body.addEventListener('drop', drop);
        document.body.addEventListener('dragover', dragOver);

        function dragMoveListener(event) {
            const target = event.target;
            const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);

            updateCardPosition(target);
        }

        // هذه الدالة ستتم استدعائها عند تحريك البطاقة
        function updateCardPosition(card) {
            const taskId = card.querySelector('.badge').textContent;
            const dataX = parseFloat(card.getAttribute('data-x'));
            const dataY = parseFloat(card.getAttribute('data-y'));

            // إرسال طلب AJAX إلى Laravel لتحديث موقع البطاقة
            axios.post('/administration/public/tasks/' + taskId + '/update-position', {
                data_x: dataX,
                data_y: dataY
            })
            .then(response => {
                console.log('Card position updated successfully');
            })
            .catch(error => {
                console.error('Error updating card position:', error);
            });
        }

        // هذه الدالة ستتم استدعائها عند إنشاء بطاقة جديدة
        function createNewCard(cardType, title) {
            axios.post('/administration/public/projects/' + projectId + '/tasks', {
                name: title,
                project_id: projectId
            })
            .then(response => {
                const taskId = response.data.id;
                const newCard = createCard(cardType, title, true);
                newCard.querySelector('.badge').textContent = taskId;

                // إضافة حدث تحريك البطاقة
                interact(newCard).draggable({
                    onmove: event => {
                        const target = event.target;
                        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                        target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                        target.setAttribute('data-x', x);
                        target.setAttribute('data-y', y);

                        updateCardPosition(target);
                    }
                });
            })
            .catch(error => {
                console.error('Error creating new card:', error);
            });
        }

        // هذه الدالة ستتم استدعائها عند تحديث حالة البطاقة (مكتملة / غير مكتملة)
        function updateCardStatus(card, completed) {
            const taskId = card.querySelector('.badge').textContent;

            axios.put('/administration/public/tasks/' + taskId, {
                completed: completed
            })
            .then(response => {
                console.log('Card status updated successfully');
            })
            .catch(error => {
                console.error('Error updating card status:', error);
            });
        }
    </script>
    <script src="{{ asset('js/men.js') }}"></script>
    @foreach(DB::table('tasks')
    ->where('project_id',$id)
                ->get() as $task)
        <div class="card task-card" draggable="true" ondblclick="deleteCard(event)"
             data-x="{{ $task->data_x }}" data-y="{{ $task->data_y }}"
             style="transform: translate({{ $task->data_x }}px, {{ $task->data_y }}px);">
            <h2 class="card-title task-card-title">{{ $task->name }}<span class="badge">{{ $task->id }}</span></h2>
        </div>
    @endforeach
    <div id="save-code-popup-parent"></div>
    <div class="card idea-card" draggable="true" ondblclick="deleteCard(event)" data-x="1760" data-y="630" style="transform: translate(1760px, 630px);">
        <h2 class="card-title idea-card-title">فكرة<span class="badge">1</span></h2>
    </div>
    <div class="card requirements-card" draggable="true" ondblclick="deleteCard(event)"  data-x="280" data-y="363.75" style="transform: translate(280px, 363.75px);">
        <h2 class="card-title requirements-card-title">شسي</h2>
    </div>
</body>
</html>
