const channel = pusher.subscribe('real-time-notifications');

channel.bind('real-time-notification-event', function (data) {
    const newNotification = `
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">

            <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header justify-content-between">
                    <small>${data.date}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                   <a class="text-sm" href="/videos/${data.video_id}">
                        تهانينا تمت معالجة مقطع الفيديو ${data.video_title} بنجاح
                   </a>
                </div>
            </div>
        
        </div>
    `;

    $('body').append(newNotification);
});