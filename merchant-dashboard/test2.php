<!DOCTYPE html>
<html>
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>

    <script type="text/javascript">
        function showHide(obj) {
            var div = document.getElementById(obj);
            if (div.style.display == 'none') {
                div.style.display = '';
            }
            else {
                div.style.display = 'none';
            }
        }
    </script>

</head>
<body>

    <table>
        <td>
        <a href="#" onclick="showHide('hidden_div'); return false;"><button>iPhone</button></a>
        <a href="#" onclick="showHide('q2'); return false;"><button>iPod</button></a>
        <a href="#" onclick="showHide('q3'); return false;"><button>Tablet</button></a>
        </td>
    </table>

    <div id="hidden_div" style="display: none;">
        <button onclick="showHide('q4'); return false;">iPhone 5</button>
        <button>iPhone 4S</button>
        <button>iPhone 4</button>
        <button>iPhone 3GS</button>
    </div>

    <div id="q2" style="display: none;">
        <button>iPod Touch</button>
        <button>iPod Nano</button>
        <button>Classic iPod</button>
    </div>

    <div id="q3" style="display: none;">
        <button>iPad</button>
        <button>Windows</button>
        <button>Nook</button>
    </div>

    <div id="q4" style="display: none;">
        <button onclick="showHide('q'); return false;">AT&T</button>
        <button>Sprint</button>
        <button>Verizon</button>
        <button>Unlocked</button>
        <button>Other</button>
    </div>

</body>
</html>