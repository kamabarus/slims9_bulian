<!DOCTYPE html>
<html lang="<?php echo substr($sysconf['default_lang'], 0, 2); ?>" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">

<?php
/*------------------------------------------------------------

Template    : Slims Akasia Template
Create Date : March 14, 2015
Author      : Eddy Subratha (eddy.subratha{at}slims.web.id)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

-------------------------------------------------------------*/
// be sure that this file not accessed directly

if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
  die("can not access this file directly");
}

?>
<!--
==========================================================================
   ___  __    ____  __  __  ___      __    _  _    __    ___  ____    __
  / __)(  )  (_  _)(  \/  )/ __)    /__\  ( )/ )  /__\  / __)(_  _)  /__\
  \__ \ )(__  _)(_  )    ( \__ \   /(__)\  )  (  /(__)\ \__ \ _)(_  /(__)\
  (___/(____)(____)(_/\/\_)(___/  (__)(__)(_)\_)(__)(__)(___/(____)(__)(__)

==========================================================================
-->

<head>

  <!-- Meta
  ============================================= -->
  <?php include "meta_template.php"; ?>

</head>
<body itemscope="itemscope" itemtype="http://schema.org/WebPage">

<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<!-- Header
============================================= -->
<?php include "header_template.php"; ?>

<!-- Navigation
============================================= -->
<?php include "navigation_template.php"; ?>

<!-- Content
============================================= -->
<?php if(isset($_GET['keywords']) || isset($_GET['p'])): ?>

  <main  id="content" class="s-main-page" role="main">

        <!-- Search on Front Page
        ============================================= -->
        <div class="s-main-search">
          <h1 class="s-main-title animated fadeInUp delay1">
          <?php
              if(!isset($_GET['p'])) :
                echo __('Collections');
              elseif ($_GET['p'] == 'show_detail') :
                echo __("Record Detail");
              elseif ($_GET['p'] == 'member') :
                echo __("Member Area");
              else :
                echo $page_title;
              endif;
          ?>
          </h1>
          <form action="index.php" method="get" autocomplete="off">
            <input type="text" class="s-search animated fadeInUp delay4" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" role="search">
            <button type="submit" name="search" value="search" class="s-btn animated fadeInUp delay4"><?php echo __('Search'); ?></button>
          </form>
        </div>

        <!-- Main
        ============================================= -->
        <div class="s-main-content container">
          <div class="row">

            <!-- Show Result
            ============================================= -->
            <div class="col-lg-8">
              <?php 
                // Generate Output
                echo $main_content;
                // Somehow we need to hack the layout
                echo (isset($_GET['keywords']) || isset($_GET['p']) && $_GET['p'] != 'member') ? '</div>' : '';
                echo (isset($_SESSION['mid'])) ? '</div></div>' : '';
              ?>

            <div class="col-lg-4">
              <?php if(isset($_GET['search'])) : ?>
              <h2><?php echo __('Search Result'); ?></h2>
              <hr>
              <?php echo $search_result_info; ?>
              <?php endif; ?>

              <br>

              <!-- If Member Logged
              ============================================= -->
              <?php if (utility::isMemberLogin()) : ?>
                <h2><?php echo __('Information'); ?></h2>
                <hr/>
                <p><?php echo $header_info; ?></p>
              <?php else: ?>
                <h2><?php echo __('Information'); ?></h2>
                <hr/>
                <p><?php echo $info; ?></p>
              <?php endif; ?>

              <br/>

              <!-- Show if clustering search is enabled
              ============================================= -->
              <?php
                if(!isset($_GET['p'])) :
                  if ($sysconf['enable_search_clustering']) : ?>
                  <h2><?php echo __('Search Cluster'); ?></h2>
                  <hr/>
                  <div id="search-cluster">
                    <div class="cluster-loading"><?php echo __('Generating search cluster...');  ?></div>
                  </div>

                  <script type="text/javascript">
                    $('document').ready( function() {
                      $.ajax({
                        url     : 'index.php?p=clustering&q=<?php echo urlencode($criteria); ?>',
                        type    : 'GET',
                        success : function(data, status, jqXHR) {
                                    $('#search-cluster').html(data);
                                  }
                      });
                    });
                  </script>

                  <?php endif; ?>
                <?php endif ?>
            </div>
          </div>
        </div>

  </main>

<?php else: ?>
  <!-- Homepage
  ============================================= -->
  <main id="content" class="s-main" role="main">

        <!-- Search form
        ============================================= -->
        <div class="s-main-search animated fadeInUp delay1">
          <form action="index.php" method="get" autocomplete="off">
            <h1 class="animated fadeInUp delay2"><?php echo __('SEARCHING'); ?></h1>
            <p class="s-search-info animated fadeInUp delay3"><?php echo __('you can start it by typing one or more keywords for title, author or subject'); ?></p>
            <input type="text" class="s-search animated fadeInUp delay4" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" x-webkit-speech="x-webkit-speech">
            <button type="submit" name="search" value="search" class="s-btn animated fadeInUp delay4"><?php echo __('Search'); ?></button>
          </form>
        </div>

        <!-- Featured
        ============================================= -->
        <a href="#" class="s-feature animated fadeInUp delay6"><?php echo __('see also our featured collections'); ?>
          <div class="s-menu-toggle animated fadeInUp delay7"><span></span></div>
        </a>
        <div class="s-feature-content">

        </div>


  </main>
<?php endif; ?>

<!-- Footer
============================================= -->
<?php include "footer_template.php"; ?>

<!-- Chat
============================================= -->
<div class="s-chat">
  
</div>


<!-- Background
============================================= -->
<?php include "bg_template.php"; ?>

</body>
</html>