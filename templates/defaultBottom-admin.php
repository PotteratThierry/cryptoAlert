
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</footer>
</html>