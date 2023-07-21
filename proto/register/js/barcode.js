window.addEventListener("load", () => {

    let detectedCode = ""; // 1度目に読み取ったバーコード
    let detectedCount = 0; // 同じバーコードの値を読み取った回数

    // カメラの設定
    let constraints = {
        audio: false,
        video: {
            width: 640,
            height: 480,
            facingMode: "environment"
        }
    }

    // カメラ許可のダイアログを表示し、許可されたらthenに書かれている内容を実行
    // エラーの場合はcatchする
    navigator.mediaDevices.getUserMedia(constraints).then(mediaStream => {
        let video = document.querySelector("video");
        video.srcObject = mediaStream;
        video.onloadedmetadata = e => {
            video.play();
        };
    }).catch(err => {
        console.log(err.name + ": " + err.message);
    });

    // QuaggaJSの初期設定
    // リアルタイムで読み取りを行うため「LiveStream」を指定
    // 「constraints」で指定する内容は「.getUserMedia」で指定したものと同じにすること
    // facingMode: "environment"でスマホの後ろのカメラを使用
    // 「decoder」で読み取るバーコードの種別を指定
    // 正常にカメラが起動できれば「if (!err)」が実行される
    Quagga.init({
        inputStream: {
            type: "LiveStream",
            constraints: {
                width: 640,
                height: 480,
                facingMode: "environment"
            },
        },
        decoder: {
            readers: ["ean_reader", "ean_8_reader"]
        }
    },
    err => {
        if(!err) {
            Quagga.start();
        } else {
            Quagga.stop();
            //alert("カメラをONにしてください");
        }
    });

    // バーコードを認識したときの処理(この部分で枠線を作成している)
    Quagga.onProcessed(result => {
        let drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

        if(result) {
            if(result.boxes) {
                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                result.boxes.filter(box => {
                    return box !== result.box;
                }).forEach(box => {
                    Quagga.ImageDebug.drawPath(box, {
                        x: 0,
                        y: 1
                    }, drawingCtx, {
                        color: "green",
                        lineWidth: 2
                    });
                });
            }

            if(result.box) {
                Quagga.ImageDebug.drawPath(result.box, {
                    x: 0,
                    y: 1
                }, drawingCtx, {
                    color: "#00F",
                    lineWidth: 2
                });
            }

            if(result.codeResult && result.codeResult.code) {
                Quagga.ImageDebug.drawPath(result.line, {
                    x: "x",
                    y: "y"
                }, drawingCtx, {
                    color: "red",
                    lineWidth: 3
                });
            }
        }
    });

    // バーコードを読み取った後の処理
    // 間違って読み取ることを防ぐため、3回読み取る
    let inputCode = document.getElementById("input-code");
    Quagga.onDetected((result) => {
        if(detectedCode == result.codeResult.code) {
            detectedCount++;
        } else {
            detectedCount = 0;
            detectedCode = result.codeResult.code;
        }

        if(detectedCount >= 3) {
            const code = result.codeResult.code;
            inputCode.value = code;
            detectedCode = "";
            detectedCount = 0;
            // Quagga.stop();これを実行すれば読み取った後カメラが止まる
        }
    });

    // 最後に削除すること。
    let buttonStopCamera = document.getElementById("button-stop-camera");
    buttonStopCamera.onclick = () => {
        Quagga.stop();
    }

});