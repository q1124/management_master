<form action="{{ url('test-import') }}" method="post" enctype="multipart/form-data">
    匯入檔案
    <input type="file" name="file">
    <input type="submit">
</form>

<form action="{{ url('test-upload') }}" method="post" enctype="multipart/form-data">
    上傳檔案
    <input type="file" name="file">
    <input type="submit">
</form>

{{ asset('storage/'.'public/Ha1ks0PfxpowGKCvfq0SMKw4NukbuPQEVo4RfQ47.jpg') }}
