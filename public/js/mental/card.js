let currentCard;
let ideaCount = 0;
let mistakesCount = 0;
let requirementsCount = 0;
let numberCount = 0;

// وظائف للتعامل مع حركة السحب والإفلات
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

// وظيفة لإنشاء بطاقة جديدة
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
    } else if (className === 'requirements-card') {
        requirementsCount++;
        badgeNumber = requirementsCount;
    } else if (className === 'number-card') {
        numberCount++;
        badgeNumber = numberCount;
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

    // إضافة البيانات إلى جدول labels
    $.ajax({
        url: '/administration/public/labels',
        type: 'POST',
        data: {
            _token: csrfToken, // استخدام رمز CSRF المخزن في المتغير العام
            text: title,
            type: className.replace('-card', ''),
            data_x: 0,
            data_y: 0
        },
        success: function(response) {
            console.log('Label added successfully');
            newElement.dataset.label = response.id; // تخزين معرف Label في بيانات العنصر
        },
        error: function() {
            console.error('Error adding label');
        }
    });

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
}

// وظيفة لحذف البطاقة
function deleteCard(event) {
    const card = event.currentTarget;
    const labelId = card.dataset.label;

    if (labelId) {
        $.ajax({
            url: `/administration/public/labels/${labelId}`,
            type: 'DELETE',
            data: {
                _token: csrfToken // استخدام رمز CSRF المخزن في المتغير العام
            },
            success: function(response) {
                console.log('Label deleted successfully');
                card.remove();
            },
            error: function() {
                console.error('Error deleting label');
            }
        });
    } else {
        card.remove();
    }
}

// وظيفة للتعامل مع حركة السحب
function dragMoveListener(event) {
    const target = event.target;
    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

    target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);

    // تحديث إحداثيات البطاقة في قاعدة البيانات
    const labelId = target.dataset.label;
    if (labelId) {
        updatePosition(labelId, x, y);
    }

  const taskId = target.dataset.task;
    if (taskId) {
  updatePositiontask(taskId, x, y);
    }
}


function updatePositiontask(labelId, x, y) {
    $.ajax({
        url: `/administration/public/tasks/${labelId}/update-position`,
        type: 'POST',
        data: {
            _token: csrfToken, // استخدام رمز CSRF المخزن في المتغير العام
            data_x: x,
            data_y: y
        },
        success: function(response) {
            console.log('Position updated successfully');
        },
        error: function() {
            console.error('Error updating position');
        }
    });
}


// وظيفة لتحديث إحداثيات البطاقة في قاعدة البيانات
function updatePosition(labelId, x, y) {
    $.ajax({
        url: `/administration/public/labels/${labelId}/update-position`,
        type: 'POST',
        data: {
            _token: csrfToken, // استخدام رمز CSRF المخزن في المتغير العام
            data_x: x,
            data_y: y
        },
        success: function(response) {
            console.log('Position updated successfully');
        },
        error: function() {
            console.error('Error updating position');
        }
    });
}
