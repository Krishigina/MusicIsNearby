<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHPMailer</title>
</head>
<body>
<form enctype="multipart/form-data" method="post" id="form" onsubmit="submitForm(event)" action="send.php">
	<p>Имя</p>
	<input placeholder="Представьтесь" name="name" type="text" >
	<p>Email</p>
	<input placeholder="Укажите почту" name="email" type="text" >
	<p>Сообщение</p>
	<textarea name="text"></textarea>
	<p>Прикрепить файлы</p>
	<input type="file" name="myfile[]" multiple id="myfile">
	<p><input value="Отправить" type="submit"></p>
</form>

<script>
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
    	alert(json.info);
    } else { 
    	// в случае ошибки
    	console.log(json.desc);
    	throw (json.info);
    }
  } catch (error) { // обработка ошибки
    alert(error);
  }
}
</script>

</body>
</html>