<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspection Assigned</title>
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
            max-width: fit-content;


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
                <div id="msg">
                    <p>
                    <h3 id="title">Inspection Assigned</h3>
                    </p>
                    <p> Hey {{$name}}, </p>
                    <p> You have been assigned to an inpsection for lab {{$lab}}. Please complete inspections at
                         <a href="www.labfiz.com/login"> www.labfiz.com</a>.
                    </p>                   
                    <p>
                        Regards,
                    <br>
                        LabFiz Admin
                    </p>
                </div>
            </section>
        </div>
    </div>
</body>

</html>