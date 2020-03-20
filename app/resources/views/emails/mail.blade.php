<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabFiz Registration</title>
    <style>
        section {
            font-family: sans-serif;
            font-size: medium;
            
        }

        #wrapper {
            background: #26a69a;
            margin: 10px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            justify-items: center;

        }


        #content {
            background: #f8fafa;
            padding: 10px;
            max-width: fit-content;
            display: flex;
            align-self: center;

        }
    </style>

</head>

<body>
    <div id="wrapper">
        <div id="content">
            <section>
                <h3 id="title">LabFiz Registration</h3>

                <div id="msg">
                    <p> Hey {{$name}}, </p>
                    <p> Your account has been created! Please use these credentials to log in <a
                            href='www.labfiz.com/login'>www.labfiz.com</a>.</p>
                    <strong>
                        <p>
                            {{$email}}
                            <br>{{$password}}</p>
                    </strong>
                    <p>
                        Regards,
                    </p>
                    <p>
                        LabFiz Admin
                    </p>
                </div>
            </section>
        </div>
    </div>
</body>

</html>