<? header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Form</title>
</head>
<body>
<div class="wrapper">
    <div class="errors" style="color: red; font-size: large">
        <? $error = array(
            'name' => 'Use 2 words in Name, latin characters',
            'phone' => 'Use correct format for Phone Number',
        ) ?>
        <? echo @$error[$_GET['error']] ?></div>
    <form method="POST" action="checkValidationData.php">
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name Surname" required/>
        </p>

        <p>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="example@email.com" required/>
        </p>

        <p>
            <label for="phone">Phone</label>
            <input type="tel" name="phone" placeholder="+(xxx) xxx-xx-xx" required/>
        </p>

        <p>
            <label for="date">Date</label>
            <input type="date" name="date" required/>
        </p>

        <p>
            <label for="url">URL</label>
            <input type="url" name="url" placeholder="http://www.example.com" required/>
        </p>

        <p>
            <label for="url">Message</label>
            <input type="text" name="message" placeholder="Your message" required/>
        </p>
        <input type="submit"/>

    </form>
</div>
</body>
</html>