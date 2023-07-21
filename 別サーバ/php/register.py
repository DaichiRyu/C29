#!/usr/local/bin/python3
import torch
import sys
import io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

print(0)
model = torch.hub.load("ultralytics/yolov5", "yolov5s", pretrained=True)
print(1)
#print(model.names)  # テスト用検出できる物体の種類,確認
for filename in sys.stdin:
    filename =str(filename).replace(" ","").replace("\n","")
filename ="000001.jpg"#コードテスト用
#gofilename = "C:/server/Apache24/htdocs/main/home/register/php/imgfiles/"#ローカルテスト用
gofilename = './imgfiles/'
gofilename += filename
#code = int.from_bytes(filename.encode('UTF-8'), 'big')#テスト用文字コード確認（以下2行）
#hexCode = f'{code:X}'
#print(hexCode) 
results = model(str(gofilename)) # 画像パスを設定し、物体検出を行う

objects = results.pandas().xyxy[0]  # 検出結果を取得
print(3)
for i in range(len(objects)):
    name = objects.name[i]
    print(f"{name}")

#results.show()  # テスト用検出した物体の表示
#results.crop()  # テスト用検出した物体の切り取り