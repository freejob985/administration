<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنسيق مقالة</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        textarea {
            width: 100%;
            height: 300px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <textarea id="articleContent" placeholder="اكتب مقالك هنا..."></textarea>
    <button onclick="formatText()">تنسيق</button>

    <script>
        function formatText() {
            var articleContent = document.getElementById("articleContent").value;
            // يمكنك إجراء عمليات تنسيق هنا
            // على سبيل المثال، يمكنك تحويل النص إلى HTML وتطبيق تنسيق عليه

            // مثال بسيط: إضافة عنوان
            articleContent = "<h1>" + articleContent + "</h1>";

            // يمكنك تحديث النص المنسق في العنصر textarea
            document.getElementById("articleContent").value = articleContent;
        }
    </script>
</body>
</html>
