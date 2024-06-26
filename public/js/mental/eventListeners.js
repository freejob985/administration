// أحداث النقر على الأزرار الجانبية
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
            createCard('idea-card', result.value, true);
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
            createCard('requirements-card', result.value);
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
            createCard('mistakes-card', result.value, true);
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
            createCard('number-card', result.value);
        }
    });
});

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
