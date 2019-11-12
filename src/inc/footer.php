</div>
</div>

</body>
<script>
    //Listen for every keydown event
    window.addEventListener("keydown", (e) => {
        //Check if the user press a key corresponding to an alphabetical letter (frm a to z)
        if (e.keyCode >= 65 && e.keyCode <= 90) {
            //Select tne corresponding submit input in the onscreen keyboard and click it
            document.querySelector("#" + e.key).click();
        }
    });  
</script>
</html>
