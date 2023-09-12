window.addEventListener('load', (event) => {
    let sort = document.getElementById('sort');
    sort.value = window.getSort();

    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const form = document.querySelector('.needs-validation')

        // Loop over them and prevent submission
        form.addEventListener('submit', event => {
            form.classList.remove('was-validated')

            if (form.checkValidity()) {
                submit();
            }
            form.classList.add('was-validated')
            event.preventDefault()
            event.stopPropagation()
        }, false)
    })()
    updateList();
});

function deactivate(id, status) {
    let request = new FormData();
    request.append('id', id);
    request.append('status', status?'1':'0');

    window.getDataByAjax('Reviews\\Update', request).then((response) => {});
}

function remove(id, row) {
    let request = new FormData();
    request.append('id', id);

    window.getDataByAjax('Reviews\\Delete', request).then((response) => {
        if(response.status){
            row.remove();
        }
    });
}

function addNewRow(json) {
    let resultElement = document.getElementById('result');
    let review = document.createElement('tr');
    let isAdmin = window.isAdmin();
    let htmlString = '' +
        '<th>' + json.id + '</th>' +
        '<td>' + json.name + '</td>' +
        '<td>' + json.email + '</td>' +
        '<td>' + json.text + '</td>' +
        '<td>' + json.images + '</td>';

    review.innerHTML = htmlString

    if (isAdmin) {
        let td = document.createElement('td');
        let checkbox = document.createElement('input');
        let button = document.createElement('button');

        checkbox.type = 'checkbox';
        checkbox.checked = !!json.active;
        checkbox.classList.add('col-12', 'mb-3');

        checkbox.addEventListener('change', (e) => {
            deactivate(json.id, e.target.checked)
        });

        button.classList.add('btn', 'btn-danger', 'col-12');
        button.innerText = 'Delete'

        button.addEventListener('click', (e) => {
            remove(json.id, review)
        });

        td.appendChild(checkbox)
        td.appendChild(button)
        review.appendChild(td);
    }


    resultElement.appendChild(review);
}

function updateList() {
    let request = new FormData();

    request.append('sort', window.getSort());
    request.append('admin', window.isAdmin() ? '1' : '0');

    window.getDataByAjax('Reviews', request).then((response) => {
        let resultElement = document.getElementById('result');
        resultElement.innerText = '';
        if (!response) {
            return;
        }

        response.forEach((el) => {
            addNewRow(el);
        })

    });
}

function submit() {
    let form = document.getElementById('review');
    let request = new FormData(form);
    request.append('sort', window.getSort());

    window.getDataByAjax('Reviews\\Create', request).then((response) => {
        if (!response) {
            return;
        }
        addNewRow(response);
    });
}
