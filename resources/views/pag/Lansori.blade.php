<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Table</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/css/mdb.min.css">
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
/* تصميم خاص */
@import url('https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap');
*{
 font-family: "Changa", sans-serif;
  font-optical-sizing: auto;

}
#data-table_wrapper .dataTables_length select {
    width: auto;
    margin-left: 5px;
}
/* مسح الاسكرول */
.dataTables_wrapper {
    overflow-x: auto;
}

/* جعل الحواف والبوردر ناعمة */
.table {
    border-radius: 10px;
    border: none; /* حذف البوردر */
    overflow: hidden;
}

.table th,
.table td {
    border-top: none;
    border-bottom: none; /* حذف البوردر */
}
/* تصميم تعدد الصفحات */
.pagination {
    justify-content: center;
}

.page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.page-link {
    color: #007bff;
    border: 1px solid #007bff;
}

.page-link:hover {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}

table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: NONE;
    BACKGROUND: #4c80f5;
    BORDER: NONE;
    color: white;
}

table.dataTable.no-footer {
    border-bottom: 1px solid #d6cfcf;
}
img.ims {
    width: 37vh;
}
  .center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 37vh; /* لتوسيط الصورة عموديًا في الوسط */
  }
table.dataTable, table.dataTable th, table.dataTable td {
    box-sizing: content-box;
    font-size: 20px;
font-weight: 400;
}
</style>

</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">لانسوري</h2>
<div class="center">
  <img src="/pngegg (1).png" alt="رمز العمل الحر" class="ims">
</div>
  <div class="table-responsive">
    <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>النص</th>
          <th>الرابط</th>
          <th>الصورة</th>
          <th>الزمن</th>
          <th>الشرط</th>
          <th>التصنيف</th>
          <th>الكلمات الرئيسية</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
<audio id="notificationSound">
    <source src="notificationSound.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<!-- أزرار الجدول -->
<th><a href="#" class="btn btn-primary" id="op1" vv="مع حضرتك مبرمج ويب بخبرة اكثر من 7 سنين في مجال برمجة الويب استطيع تنفيذ المطلوب بأحترافية وفي الوقت المطلوب">برمجة</a></th>
<th><a href="http://localhost/ask.php" class="btn btn-secondary" target="_blank"> اضافة سؤال</a></th>
<th><a href="#" class="btn btn-success" target="_blank" >انشئ مشروع</a></th>
<th><a href="#" class="btn btn-danger">زر 4</a></th>
<th><a href="#" class="btn btn-warning">زر 5</a></th>
<th><a href="#" class="btn btn-info">زر 6</a></th>
<th><a href="#" class="btn btn-light">زر 7</a></th>
<th><a href="#" class="btn btn-dark">زر 8</a></th>
<th><a href="#" class="btn btn-primary">زر 1</a></th>
<th><a href="#" class="btn btn-secondary">زر 2</a></th>


  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.2/js/mdb.min.js"></script>
<script>
$(document).ready(function() {
    // دالة لتحميل البيانات
    function loadData() {
        fetch('https://bb.egyticsports.com/public/api/order')
          .then(response => response.json())
          .then(data => {
            console.log(data);
            // بناء الجدول باستخدام DataTables
            $('#data-table').DataTable({
                destroy: true, // إزالة الجدول الحالي قبل إعادة بنائه
                data: data.results,
                columns: [
                    { data: 'id' },
                    { data: 'text' },
                    {
                        data: 'Link',
                        render: function(data) {
                            return '<a href="' + data + '" class="btn btn-primary btn-sm btn1" id="btn1" vv="مع حضرتك مبرمج ويب بخبرة اكثر من 7 سنين في مجال برمجة الويب استطيع تنفيذ المطلوب بأحترافية وفي الوقت المطلوب" target="_blank">مشاهدة العرض</a>';
                        }
                    },
                    { data: 'picture', render: function(data) { return '<img src="' + data + '" width="50" height="50">' } },
                    {
                        data: 'time',
                        render: function(data) {
                            return getTimeSince(data);
                        }
                    },
                    {
                        data: 'condition',
                        render: function(data) {
                            return '<button class="btn btn-success btn-sm btn-condition" data-condition="' + data + '">الشرط</button>';
                        }
                    },
                    { data: 'sort' },
                    { data: 'keywords' }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json'
                },
                pageLength: 50 // تحديد حد الصفحة ليكون 50

            });
            // تشغيل صوت الإشعار
            document.getElementById('notificationSound').play();
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
    }

    // تحميل البيانات لأول مرة عند تحميل الصفحة
    loadData();

    // تحديث البيانات بانتظام كل 60 ثانية (يمكنك تغيير هذا الرقم وفقًا لاحتياجاتك)
    setInterval(loadData, 30000);

    // دالة لحساب الزمن المنقضي منذ
    function getTimeSince(time) {
        const currentTime = new Date().getTime();
        const elapsedTime = currentTime - time * 1000; // تحويل الوقت إلى ملي ثانية
        const seconds = Math.floor(elapsedTime / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (days > 0) {
            return days + " يوم";
        } else if (hours > 0) {
            return hours + " ساعة";
        } else if (minutes > 0) {
            return minutes + " دقيقة";
        } else {
            return seconds + " ثانية";
        }
    }
});


    $('#data-table').on('click', '.btn-condition', function() {
        var rowId = $(this).closest('tr').find('td:first-child').text(); // الحصول على معرف الصف
        var id = $(this).data('id'); // الحصول على الـ id

        // تعيين المتغير button للزر الذي تم النقر عليه
        var button = $(this);

        // تكوين الرابط بمعرف الصف والـ id
        var url = 'https://bb.egyticsports.com/public/api/update-freelancing/' + rowId + '?id=' + id;

        // إرسال الطلب GET إلى الرابط المحدد
        $.post(url, function(response) {
            // يمكنك هنا إضافة أي رمز يعالج الاستجابة بشكل صحيح
            // قم بتغيير لون الزر إلى الأحمر
            button.removeClass('btn-success').addClass('btn-danger');
        });
    });


$(document).ready(function() {
    // استجابة لنقر الزر
    $('.btn1').on('click', function() {
        // احصل على قيمة الخاصية "vv" من الزر
        var textToCopy = $("#op1").attr('vv');

        // إنشاء عنصر textarea لوضع النص فيه
        var textArea = document.createElement("textarea");
        textArea.value = textToCopy;

        // إضافة العنصر إلى DOM
        document.body.appendChild(textArea);

        // حدد النص في العنصر textarea
        textArea.select();

        // نسخ النص إلى الحافظة
        document.execCommand('copy');

        // قم بإزالة العنصر textarea بمجرد الانتهاء من النسخ
        document.body.removeChild(textArea);

        // عرض رسالة تأكيد
        alert('تم نسخ النص بنجاح: ' + textToCopy);
    });
});


</script>
<script>
$(document).ready(function() {
    // استجابة لنقر الزر
    $(document).on('click', '.btn1', function() {
        // احصل على النص من الخاصية "vv" للزر
        var textToCopy = $(this).attr('vv');

        // إنشاء عنصر textarea لوضع النص فيه
        var textArea = document.createElement("textarea");
        textArea.value = textToCopy;

        // إضافة العنصر إلى DOM
        document.body.appendChild(textArea);

        // حدد النص في العنصر textarea
        textArea.select();

        // نسخ النص إلى الحافظة
        document.execCommand('copy');

        // قم بإزالة العنصر textarea بمجرد الانتهاء من النسخ
        document.body.removeChild(textArea);

        // عرض رسالة تأكيد
        // alert('تم نسخ النص بنجاح: ' + textToCopy);
    });
});
</script>


</body>
</html>
