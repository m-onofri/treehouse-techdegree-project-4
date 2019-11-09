</div>
</div>

</body>
<script>
    window.addEventListener("keydown", (e) => {
        if (e.keyCode >= 65 && e.keyCode <= 90) {
            document.querySelector("#" + e.key).click();
        }
    });  
</script>
</html>
