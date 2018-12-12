
    </div> <!-- /container -->
</body>
<footer>
    <div class="navbar fixed-bottom navbar-light bg-light" role="navigation">
        <p>
        <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
            <label><?php echo $lang_choiceLang;?> : </label>
            <button name="<?php echo LANG;?>" value="<?php echo CH_FR;?>" type="submit" class="flag ch-fr <?php if($lang != CH_FR){echo 'no-lang' ;}?>"></button>
            <button name="<?php echo LANG;?>" value="<?php echo UK_EN;?>" type="submit" class="flag uk-en <?php if($lang != UK_EN){echo 'no-lang' ;}?>"></button>
            <button name="<?php echo LANG;?>" value="<?php echo CH_DE;?>" type="submit" class="flag ch-de <?php if($lang != CH_DE){echo 'no-lang' ;}?>"></button>
            <button name="<?php echo LANG;?>" value="<?php echo CH_IT;?>" type="submit" class="flag ch-it <?php if($lang != CH_IT){echo 'no-lang' ;}?>"></button>
        </form>
        </p>
        <p>
            Potterat Thierry 2014
        </p>
    </div>

    <!-- les scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</footer>
</html>