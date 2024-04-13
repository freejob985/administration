// 在 document ready 或 window load 事件中执行
$(document).ready(function() {
    // 在打开评论模态框时加载评论
    $('#commentsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var scheduleId = button.data('schedule-id');

        // 加载评论
        loadComments(scheduleId);
    });

    // 添加新评论
    $('#addCommentButton').click(function() {
        var commentText = $('#commentTextarea').val();
        var scheduleId = $('#commentsModal').data('schedule-id');

        // 保存新评论
        saveComment(scheduleId, commentText);
    });
});

function loadComments(scheduleId) {
    $.ajax({
        url: '/schedule/' + scheduleId + '/comments',
        type: 'GET',
        success: function(data) {
            // 清空现有评论
            $('.comments-list').empty();

            // 渲染评论
            data.forEach(function(comment) {
                var commentHtml = `
                    <div class="mb-3 comment-card">
                        <div class="d-flex justify-content-between">
                            <h6>${comment.user.name}</h6>
                        </div>
                        <p style="white-space: pre-line;">${comment.content}</p>
                    </div>
                `;
                $('.comments-list').append(commentHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function saveComment(scheduleId, commentText) {
    $.ajax({
        url: '/schedule/' + scheduleId + '/comments',
        type: 'POST',
        data: {
            content: commentText
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            // 清空评论文本框
            $('#commentTextarea').val('');

            // 添加新评论到列表
            var newComment = `
                <div class="mb-3 comment-card">
                    <div class="d-flex justify-content-between">
                        <h6>${data.user.name}</h6>
                    </div>
                    <p style="white-space: pre-line;">${data.content}</p>
                </div>
            `;
            $('.comments-list').append(newComment);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
