<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        dl {
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-sizing: border-box;
        }

        dt {
            margin: 30px auto 10px;
            padding-bottom: 5px;
            font-size: 18px;
            font-weight: bold;
            line-height: 1.4;
            border-bottom: #111 3px solid;
        }

        dd div {
            margin: 0 auto 15px;
            background: #e9e9e9;
            border-radius: 10px;
        }

        dd div label {
            padding: 15px;
            display: block;
        }

        dd div span {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.4;
            display: block;
        }
    </style>
</head>

<body>
    <dl>
        <dt>写真</dt>
        <dd>
            <div>
                <label><span>背面カメラ</span>
                <!-- カメラ映るがQR認識しない -->
                    <input type="file" capture="environment" accept="image/*"></label>
                <!-- <input id="upload" type="file" name="image" accept="image/*" capture="environment"> -->

            </div>
        </dd>
    </dl>
</body>

</html>