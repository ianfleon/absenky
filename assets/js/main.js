function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    // console.log(`Scan result: ${decodedText}`, decodedResult);
    // console.log(decodedText);
    resultqr(decodedText);
    stopqr();
}

function stopqr()
{
    // console.log("STOP!");
    const video = document.querySelector('video');
    // A video's MediaStream object is available through its srcObject attribute
    const mediaStream = video.srcObject;

    // Through the MediaStream, you can get the MediaStreamTracks with getTracks():
    const tracks = mediaStream.getTracks();

    // Tracks are returned as an array, so if you know you only have one, you can stop it with: 
    tracks[0].stop();

    // console.log(tracks[0]);

    setTimeout(() => {
        startqr();
    }, 250);

}

function startqr()
{
    html5QrcodeScanner.render(onScanSuccess);
}

function resultqr(id)
{
    console.log("Checking data staff..");
    $.ajax({
        url: 'api.php?ep=get_staff_by_id',
        method: 'GET',
        data: {
            id_staff: id
        },
        success: function(res) {
            res = JSON.parse(res);
            // console.log(res);
            if (res.status == 200) {
                showstaff(res.data);
            }
        }
    });
}

function showstaff(data)
{
    $('#foto_staff').attr('src', '/public/foto/' + data['foto_staff']);
    $('#nama_staff').html(data['nama_staff']);
    $('#posisi_staff').html(data['posisi_staff']);
}

// FPS -> Scan ulang setiap 1 detik
var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", {
        fps: 30,
        qrbox: 320,
        disableFlip: false
    }
);

startqr();