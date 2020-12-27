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
        <label>File</label>
        <input type="file" id="CREATEDDATE">
    </div>
</div>

</body>
<script src="https://cdn.priority-software.com/upgrades/var/api/head/priorityapp.nocache.js"></script>
<script>

    let mainFormHandler;
    let subform;
    function fieldChangeHandler(event){
        image_url  = 'https://img.ltwebstatic.com/images3_pi/2020/02/12/15815005210dc126230f8d5d7fb23f909a3121d300_thumbnail_600x.webp';
        function toDataURL(url) {
            return fetch(url).then((response) => {
                return response.blob();
            }).then(blob => {
                return URL.createObjectURL(blob);
            });
        }

        let dfile =  toDataURL(image_url).then(
            function(){
                console.log(dfile);
            }
        );
         subform =   mainFormHandler.startSubForm('EXTFILES',null,null,function(subform){
            // console.log(obj);
             file_obj = event.target.files[0];
             console.log('file path= '+file_obj.mozFullPath);

             let uploadResult =  subform.uploadFile(file_obj,function(){
                 console.log('on progress...');
             },async function (fileUploadResult){
                 console.log('im after upload staert...');
                 console.log(fileUploadResult);
                 if (fileUploadResult.isLast) {
                     console.log("Done");
                     await subform.newRow();
                     await subform.fieldUpdate("EXTFILENAME", fileUploadResult.file);
                     await subform.fieldUpdate("EXTFILEDES", 'file name');
                     await subform.saveRow(0);
                 }else {
                     console.log("File upload progress " + fileUploadResult.progress);
                     await subform.newRow();
                     await subform.fieldUpdate("EXTFILENAME", fileUploadResult.file);
                     await subform.fieldUpdate("EXTFILEDES", 'file name');
                     await subform.saveRow(0);
                 }
             });
         },function(error){
            console.log(error);
         });
    }
    function updateFields(result) {
        if (result["CUSTOMERS"]) {
            var fields = result["CUSTOMERS"][1];
            for (var fieldName in fields) {
                var el = document.getElementById(fieldName);
                if(el) el.value = fields[fieldName];
            }
        }
    }
    function showErrorMessage(message) {
            alert(message);
    }
    function priorityReady() {
        console.log('Priority Ready');
        let config = {
            url: 'https://devpri.roi-holdings.com',
            tabulaini: 'tabula.ini',
            language: 3,
            profile: {
                company: 'demo2',
            },
            appname: 'demo',
            username: 'demo',
            password: '1234567',
            devicename: 'Roy'
        };
        login(config).then(
            async function(){
                console.log('You are in...');
                 mainFormHandler = await formStart('ORDERS', null, null, 'demo2', 0);
                console.log(mainFormHandler);
                //set a filter and search for ORDNAME - SO19001473

                let filter = {

                    or: 0,

                    ignorecase:1,

                    QueryValues: [{

                        field : "ORDNAME",

                        fromval : "SO20018070",

                        op : "=",

                        sort : 0,

                        isdesc : 0

                    }]};

                //set a new filter

                await mainFormHandler.setSearchFilter(filter);

                //get the specific row by this filter

                await mainFormHandler.getRows(1);






                //let uploadResult = await subform.uploadFile('c:\tmp\test.txt',null,null);

                /*
                let uploadResult = await subform.uploadDataUrl(dataURI, fileType, function (fileUploadResult) {

                    if (fileUploadResult.isLast) {

                        console.log("Done");

                    }else {

                        console.log("File upload progress" + fileUploadResult.progress);

                    }

                });*/

            },
            reason => {
                console.log(reason.message);
            }
        );
    }
</script>
</html>