<div>
    <!-- Include Material Design fonts and styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/13.0.0/material-components-web.min.css">
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.19/sweetalert2.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include MDBootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://localhost/administration/public/css/Tables/Tables.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <!-- TinyMCE CSS -->
    <link rel="stylesheet" href="https://cdn.tiny.cloud/1/no-api-key/tinymce/6.3.1/skins/ui/oxide/skin.min.css">

    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <!-- Custom Arabic Font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap');

        body {
            font-family: "Noto Kufi Arabic", sans-serif;
        }

        td {
            text-align: center;
        }

        /* CSS for Subtasks Modal */
        #subtasksModal .modal-body .card {
            margin-bottom: 10px;
        }

        #subtasksModal .modal-body .card-body {
            display: flex;
            align-items: center;
        }

        #subtasksModal .modal-body .form-check-label {
            margin-bottom: 0;
            margin-left: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #subtasksModal .modal-body input[type="text"] {
            width: 100%;
        }

        .dropzone {
            min-height: 150px;
            border: unset;
            background: #9551b7;
            padding: 20px 20px;
            color: white;
            font-size: 26px;
            text-transform: capitalize !important;
            font-weight: 800;
        }

        /* CSS for Progress Bar */
        .progress-container {
            width: 100%;
            height: 20px;
            background-color: #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #28a745;
            width: 0%;
            text-align: right;
            line-height: 20px;
            color: white;
            font-weight: bold;
            padding-right: 5px;
        }

        .card {
            box-shadow: -2px 1px 3px 0px #eeeeee;
            border: 0.5px solid #e3e3e3 !important;
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: unset;
        }

        .comment-card {
            border: 1px solid #e3e3e3;
            padding: 10px;
            border-radius: 5px;
        }

    </style>

    <style>
        .priority-container {
            display: flex;
            align-items: center;
        }

        .priority-circle {
            display: inline-block;
            width: 20px;
            height: 18px;
            border-radius: 107%;
            margin-left: 5px;
        }


        .priority-circle.low {
            background-color: green;
        }

        .priority-circle.medium {
            background-color: orange;
        }

        .priority-circle.high {
            background-color: red;
        }

        html {
            scroll-behavior: smooth;
        }

        /* إضافة هذه الأنماط CSS */
        * {
            /* -webkit-border-radius: 6px !important;
            -moz-border-radius: 6px !important;
            border-radius: 6px !important; */
        }

        /* إضافة هذه الأنماط CSS */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f5f5f5;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #bdbdbd;
            border-radius: 2px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #9e9e9e;
        }

    </style>


</div>
