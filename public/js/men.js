let currentCard;
let ideaCount = 0;
let mistakesCount = 0;
const projectId = '{{ $id }}'; // Assign the value of $id from Laravel

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

        updateCardPosition(target); // Call the function to update the card position
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

    updateCardPosition(target); // Call the function to update the card position
}

// This function will be called when the card is moved
function updateCardPosition(card) {
    const taskId = card.querySelector('.badge').textContent;
    const dataX = parseFloat(card.getAttribute('data-x'));
    const dataY = parseFloat(card.getAttribute('data-y'));

    // Send an AJAX request to Laravel to update the card position
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

// This function will be called when creating a new card
function createNewCard(cardType, title) {
    axios.post('/administration/public/projects/' + projectId + '/tasks', {
        name: title,
        project_id: projectId
    })
    .then(response => {
        const taskId = response.data.id;
        const newCard = createCard(cardType, title, true);
        newCard.querySelector('.badge').textContent = taskId;

        // Add the card move event
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

// This function will be called when updating the card status (completed/not completed)
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

// Event listeners for creating new cards
document.querySelector('.home.idea').addEventListener('click', function() {
    Swal.fire({
        title: 'أدخل عنوان الفكرة:',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
            if (!title) {
                Swal.showValidationMessage('الرجاء إدخال عنوان الفكرة');
            }
            return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            createNewCard('idea-card', result.value);
        }
    });
});

document.querySelector('.favorite.requirements').addEventListener('click', function() {
    Swal.fire({
        title: 'أدخل عنوان المتطلبات:',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
            if (!title) {
                Swal.showValidationMessage('الرجاء إدخال عنوان المتطلبات');
            }
            return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            createNewCard('requirements-card', result.value);
        }
    });
});

document.querySelector('.shopping_cart.mistakes').addEventListener('click', function() {
    Swal.fire({
        title: 'أدخل عنوان الأخطاء:',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
            if (!title) {
                Swal.showValidationMessage('الرجاء إدخال عنوان الأخطاء');
            }
            return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            createNewCard('mistakes-card', result.value);
        }
    });
});

document.querySelector('.settings.number').addEventListener('click', function() {
    Swal.fire({
        title: 'أدخل عنوان الأرقام:',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'إلغاء',
        showLoaderOnConfirm: true,
        preConfirm: (title) => {
            if (!title) {
                Swal.showValidationMessage('الرجاء إدخال عنوان الأرقام');
            }
            return title;
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            createNewCard('number-card', result.value);
        }
    });
});
