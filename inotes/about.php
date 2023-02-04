<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <style>
        body
        {
            background-color: #d0d0d0;
        }
         #upper-web-content {
            display: flex;
            flex-direction: column;
            position: relative;
            height: 600px;
            
        }

        #left-align {
            display: flex;
            flex-direction: column;
            position: absolute;
            padding: 45px;
        }

        #right-align {
            position: absolute;
            right: 100px;
            top: 44px;
        }

        #right-align>h1 {
            font-size: 65px;
            font-weight: bold;
            color: #160f05;
        }

        #right-align>p {
            padding-top: 25px;
            color: #160f05;
            text-align: left;
            font-size: 18px;
            letter-spacing: 1.5px;
            line-height: 35px;
        }

        #middle-web-content {
            display: flex;
            flex-direction: column;
            position: relative;
            
            padding: 0px 45px;
        }

        #middle-web-content>p {
            color: #160f05;
            text-align: left;
            font-size: 18px;
            letter-spacing: 1.5px;
            line-height: 35px;
        }

        #middle-web-content>h1 {
            font-size: 65px;
            font-weight: bold;
            color: #160f05;
        }
    </style>
    

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DiGiNoTeS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../inotes/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../inotes/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../inotes/contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    
    <div id="upper-web-content">
        <div class="container-fluid" style="padding:5px; margin: 2px;padding-bottom: 0px;margin-bottom: 0px;">
            <div id=left-align>
                <img src="../inotes/assets/logo1.jpeg" alt="about img" height="450px" width="600px" />
            </div>
            <div id="right-align">
                <h1>DiGiNoTeS</h1>
                <p>The smart way to Keep Your notes at anywhere through internet<br> Your private notes that help you to remind any of the thing.</p>
                <p>We have more then 20 million clients that uses it and give better result<br> as feedback of his experience.The note that contains Tabular record<br> which can be use to remind your work.</p>
                <p>Explore and Enjoy your onilne Diary.</p>
            </div>
        </div>
    </div>
    <div id="middle-web-content">
        <p>The DiGiNotes is the online Diary that can be use through your cellphone or laptop that gives the releif from your paper diary and you can edit or delete your notes as per you demand.</p>
        <p>You can create your note by adding some title or heading of the note and then describe your note in description once your fill both title and description you can add your note by click on the Add Note button. The note will be shown on Table given below, you can also search you note by searchbar on the table and also can be edit by click on edit button.</p>
    </div>
    
</body>

</html>