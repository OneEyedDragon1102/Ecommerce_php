<script src="https://code.jquery.com/jquery-3.7.0.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src = "./assets/js/buttons.js"></script>
<!-- Alertifyy JS -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    <?php
        if(isset($_SESSION['message'])){
        ?>
            alertify.set('notifier','position', 'top-right');
            alertify.success('<?=$_SESSION['message'];?>');
        <?php
            unset($_SESSION['message']);
        }
    ?>
</script>
</body>
</html>