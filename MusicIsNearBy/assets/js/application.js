
$(document).ready(function () {
    searchSchool(); // Функция для обработки поиска
});

// Обрабатываем поиск при фокусе на поле ввода
$('#searchSchool').on('focus', function () {
    searchSchool(); // Функция для обработки поиска
});

// Функция для обработки поиска
function searchSchool() {
    let query = $('#searchSchool').val();

    // Выполнение Ajax-запроса
    $.ajax({
        url: 'search_school.php', // Создайте отдельный файл для обработки поиска
        method: 'GET',
        data: { query: query, school_name: query }, // Используйте значение из поля ввода в качестве school_name
        succss: function (data) {
            $('#searchResults').html(data);
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchSchool");
    const searchResults = document.getElementById("searchResults");
    const searchInstrumentInput = document.getElementById("typeInstrument");
    const searchInstrumentResults = document.getElementById("searchInstrumentResults");
    const searchModelInput = document.getElementById("model");
    const searchModelResults = document.getElementById("searchModelResults");

    function fillField(input, results, value) {
        input.value = value;
        results.innerHTML = "";
    }

    function clearInstrumentAndModelFields() {
        searchInstrumentInput.value = "";
        searchModelInput.value = "";
        searchInstrumentResults.innerHTML = "";
        searchModelResults.innerHTML = "";
    }

    function handleResults(results, callback) {
        results.addEventListener("click", function (e) {
            if (e.target.tagName === "LI") {
                callback(e.target.textContent);
            }
        });

    }



    handleResults(searchResults, function (value) {
        fillField(searchInput, searchResults, value);
        clearInstrumentAndModelFields();
    });

    function updateResults(input, results, url) {
        const query = input.value;

        // Отправить запрос на сервер для получения подсказок
        // (вы можете использовать AJAX или другие методы для этого)

        // В данном примере, давайте сделаем простой запрос с использованием fetch
        fetch(url + `?query=${query}&school_name=${searchInput.value}&type=${searchInstrumentInput.value}`)
            .then(response => response.text())
            .then(data => {
                results.innerHTML = data;
            })
            .catch(error => {
                console.error("Ошибка при выполнении запроса:", error);
            });
    }

    function handleInput(input, results, url) {
        function updateResultsDebounced() {
            updateResults(input, results, url);
        }

        input.addEventListener("focus", updateResultsDebounced);
        input.addEventListener("input", updateResultsDebounced);
        input.addEventListener("change", updateResultsDebounced);
        input.addEventListener("click", updateResultsDebounced);
    }


    handleResults(searchResults, function (value) {
        fillField(searchInput, searchResults, value);
    });

    handleResults(searchInstrumentResults, function (value) {
        fillField(searchInstrumentInput, searchInstrumentResults, value);
    });

    handleResults(searchModelResults, function (value) {
        fillField(searchModelInput, searchModelResults, value);
    });

    handleInput(searchInput, searchResults, 'search_school.php');
    handleInput(searchInstrumentInput, searchInstrumentResults, 'search_instrument.php');
    handleInput(searchModelInput, searchModelResults, 'search_model.php');
});

async function submitForm(event) {
    event.preventDefault(); // отключаем перезагрузку/перенаправление страницы
    try {
        // Формируем запрос
        const response = await fetch(event.target.action, {
            method: 'POST',
            body: new FormData(event.target)
        });
        // проверяем, что ответ есть
        if (!response.ok) throw (`Ошибка при обращении к серверу: ${response.status}`);
        // проверяем, что ответ действительно JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw ('Ошибка. Ответ не JSON');
        }
        // обрабатываем запрос
        const json = await response.json();
        if (json.result === "success") {
            // в случае успеха
            // alert(json.info);
            document.querySelector('.loading').classList.add('d-none');
            document.querySelector('.alert-success').classList.remove('d-none');
            setTimeout(function () {
                document.querySelector('.alert-success').classList.add('d-none');
                document.getElementById("searchSchool").value = "";
                document.getElementById("typeInstrument").value = "";
                document.getElementById("model").value = "";
            }, 5000);

        } else {
            // в случае ошибки
            console.log(json.desc);
            throw (json.info);
            document.querySelector('.loading').classList.add('d-none');
            document.querySelector('.alert-danger').classList.remove('d-none');
            setTimeout(function () {
                document.querySelector('.alert-danger').classList.add('d-none');
            }, 5000);
        }
    } catch (error) { // обработка ошибки
        alert(error);
    }
}
