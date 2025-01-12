@extends('layouts.master')

@section('title', 'Tools - Character Count')

@section('styles')
    <style>
        textarea,
        input {
            width: 100%;
            font-size: 16px;
            padding: 10px;
            margin: 10px 0;
        }

        .output {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            white-space: pre-wrap;
            word-wrap: break-word;
            min-height: 150px;
        }

        .counter {
            font-size: 16px;
            color: #333;
            margin: 5px 0 20px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
            padding: 10px 0px;
            /* border: 1px solid red; */
            border-radius: 5px;
        }
    </style>

@section('content')

    <!-- Ô kiểm tra số ký tự nhập vào -->
    <div class="card m-3">
        <div class="card-header">
            <h2>Kiểm tra số ký tự nhập vào</h2>
        </div>
        <div class="card-body">
            <label for="inputText">Nhập nội dung:</label>
            <textarea rows="7" id="inputText" placeholder="Nhập nội dung tại đây..."></textarea>
            <div class="counter">Số ký tự đã nhập: <span id="charCount">0</span></div>

            <!-- Ô nhập số lượng ký tự mong muốn -->
            <div class="error" id="errorText"></div>
            <label for="charLength">Nhập số lượng ký tự muốn tạo:</label>
            <input id="charLength" type="number" placeholder="Nhập số ký tự mong muốn (VD: 100)" />

            <!-- Hiển thị nội dung -->
            <div class="output" id="outputContent">
                Nội dung được hiển thị ở đây.
            </div>
        </div>
    </div>

    <script>
        // Lấy các phần tử DOM
        const inputText = document.getElementById("inputText");
        const charCount = document.getElementById("charCount");
        const charLength = document.getElementById("charLength");
        const outputContent = document.getElementById("outputContent");
        const errorText = document.getElementById("errorText");

        // Lắng nghe sự kiện nhập nội dung
        inputText.addEventListener("input", () => {
            // Đếm số ký tự đã nhập
            const textLength = inputText.value.length;
            charCount.textContent = textLength;

            // Cập nhật nội dung hiển thị
            outputContent.textContent = inputText.value;
        });

        // Lắng nghe sự kiện nhập số lượng ký tự
        charLength.addEventListener("input", () => {
            const desiredLength = parseInt(charLength.value, 10);
            const baseText = inputText.value;

            // Xóa thông báo lỗi nếu giá trị hợp lệ
            errorText.textContent = "";

            // Kiểm tra nếu chưa nhập nội dung
            if (!baseText) {
                outputContent.textContent = "Vui lòng nhập nội dung vào ô đầu tiên.";
                return;
            }

            // Kiểm tra giá trị số ký tự mong muốn
            if (desiredLength > 1000000) {
                errorText.textContent = "Số ký tự không được vượt quá 1,000,000!";
                outputContent.textContent = "";
                return;
            }

            // Tạo nội dung với số ký tự mong muốn
            const repeatCount = Math.floor(desiredLength / baseText.length);
            const longText = baseText.repeat(repeatCount);
            const remainingChars = desiredLength - longText.length;

            // Ghép phần nội dung còn thiếu
            const finalText = longText + baseText.slice(0, remainingChars);

            // Hiển thị nội dung đã tạo
            outputContent.textContent = finalText;
        });
    </script>
@endsection
