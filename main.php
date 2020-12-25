<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Customer Entry</title>
    <style>
        .item {
            margin: 20px 10px 20px 10px;
        }

        input {
            width: 200px;
            height: 30px;
            font-size: 16px;
        }

        label {
            font-size: 16px;
            display: inline-block;
            width: 150px;
        }
    </style>

</head>
<body>
<div id="container" onchange="fieldChangeHandler(event)">
    <div class="item">
        <label class="labelStyle">Customer Number</label>
        <input id="CUSTNAME">
    </div>
    <div class="item">
        <label>Customer Name</label>
        <input id="CUSTDES">
    </div>
    <div class="item">
        <label>Status</label>
        <input id="STATDES">
    </div>
    <div class="item">
        <label>Assigned to</label>
        <input id="OWNERLOGIN">
    </div>
    <div class="item">
        <label>Date Opened</label>
        <input id="CREATEDDATE">
    </div>
</div>

</body>
<script src="https://cdn.priority-software.com/upgrades/var/api/head/priorityapp.nocache.js"></script>
<script>
    function priorityReady()
    {
        console.log('Priority Ready');
        var config={
            url:'https://devpri.roi-holdings.com',
            tabulaini:'tabula.ini',
            language:3,
            profile: {
                company: 'demo2',
            },
            appname:'demo',
            username:'demo',
            password: '1234567',
            devicename:'Roy'
        };
        login(config).then(
            onsuccess=>
            {
                console.log('Your are in!! Enjoy!');
            },
            reason=>
            {
                console.log(reason.message);
            }
        );
        console.log('Im here');
    }
</script>
</html>