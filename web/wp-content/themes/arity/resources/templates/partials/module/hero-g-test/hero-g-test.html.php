<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Hero A - No Image
  Template Type:      Module
  Description:        Hero module with wo inline image.
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class($data['classes']); ?>>
  <style>

  .hero-a {
    position: relative;
    background-image: none !important;
  }

  .hero-a__col.left-- {
   background-image: -webkit-linear-gradient(left, rgba(238,238,238,0.00) 0%, #f7f7f7 20%, #f7f7f7 25%, rgba(255,255,255,0.00) 90%);
   background-image: -o-linear-gradient(left, rgba(238,238,238,0.00) 0%, #f7f7f7 20%, #f7f7f7 25%, rgba(255,255,255,0.00) 90%);
   background-image: linear-gradient(to right, rgba(238,238,238,0.00) 0%, #f7f7f7 20%, #f7f7f7 25%, rgba(255,255,255,0.00) 90%);
  }

  /* .container {
    position: absolute;
    top: 0;
  } */

  #loader {
  position: relative;
  position: absolute;
  height: 650px;
  width: 130%;
  left: -200px;
  top: 0;
  /* background-color: #00ff00; */
}

#loader ul, #loader-two ul {
  /* margin: 0;
  width: 390px;
  position: relative;
  padding: 0; */
  /* height: 210px;
  height: 650px;
  width: 1200px; */
  /* background-color: #ff00ff; */
  list-style: none;
}
#loader ul li,
#loader-two ul li {
  position: absolute;
  width: 40px;
  height: 18px;
  /* margin-top:20px; */
  background-color: rgba(118,134,147,0.05);
  /* bottom: 0; */
  border-radius: 18px;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.right li {
  left: auto;
  right: 0;
}

.animate #loader li:nth-child(1) {
  top: 518px;
  animation: sequence1 4s ease-in-out 1 1s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(2) {
  top: 168px;
  animation: sequence4 4s ease-in-out 1 2.2s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(3) {
  top: 518px;
  animation: sequence6 4s ease-in-out 1 1s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots.png") repeat 16px -4px;
  background-size: 116px;
}

.animate #loader li:nth-child(4) {
  top: 118px;
  animation: sequence8 4s ease-in-out 1 2s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots.png") repeat 16px -4px;
  background-size: 116px;
}

.animate #loader li:nth-child(5) {
  top: 218px;
  animation: sequence10 4s ease-in-out 1 3s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(6) {
  top: 268px;
  animation: sequence1 4s ease-in-out 1 1.1s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
}

.animate #loader li:nth-child(7) {
  top: 418px;
  animation: sequence4 4s ease-in-out 1 2.4s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
  background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots.png") repeat 16px -4px;
  background-size: 116px;
}


.animate #loader li:nth-child(8) {
  top: 268px;
  animation: sequence6 4s ease-in-out 1 3s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
}
.animate #loader li:nth-child(9) {
  top: 368px;
  animation: sequence7 4s ease-in-out 1 1.1s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
}

.animate #loader li:nth-child(10) {
  top: 318px;
  animation: sequence9 4s ease-in-out 1 1.4s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
}


.animate #loader li:nth-child(11) {
  top: 518px;
  width: 18px;
  animation: sequence1 4s ease-in-out 1 3.3s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(12) {
  top: 118px;
  width: 18px;
  animation: sequence3 4s ease-in-out 1 2.4s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}
.animate #loader li:nth-child(13) {
  top: 518px;
  width: 18px;
  animation: sequence4 4s ease-in-out 1 3.6s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots.png") repeat 16px -4px;
  background-size: 116px;
}


.animate #loader li:nth-child(14) {
  left: auto;
  right: 0;
  top: 518px;
  animation: bsequence1 4s ease-in-out 1 1s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(15) {
  left: auto;
  right: 0;
  top: 468px;
  animation: bsequence2 4s ease-in-out 1 1.5s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots.png") repeat 16px -4px;
  background-size: 116px;
}


.animate #loader li:nth-child(16) {
  left: auto;
  right: 0;
  top: 518px;
  animation: bsequence2 4s ease-in-out 1 2s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(17) {
  left: auto;
  right: 0;
  top: 118px;
  animation: bsequence8 4s ease-in-out 1 1.3s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
}

.animate #loader li:nth-child(18) {
  left: auto;
  right: 0;
  top: 218px;
  animation: bsequence2 4s ease-in-out 1 1.6s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots.png") repeat 16px -4px;
  background-size: 116px;
}



.animate #loader li:nth-child(19) {
  top: 268px;
  animation: bsequence8 4s ease-in-out 1 2.8s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
}
.animate #loader li:nth-child(20) {
  top: 468px;
  animation: bsequence1 4s ease-in-out 1 1.5s;
  -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
  animation-fill-mode: forwards;
  background-color: rgba(118,134,147,0.2);
}


  @keyframes sequence1 {
  0% {
    left: 0%;
    width: 46px;
  }
  100%{
    left: 30%;
    width: 46px;
  }
}

@keyframes bsequence1 {
  0% {
    right: 0%;
    width: 46px;
  }
  100%{
    right: 40%;
    width: 46px;
  }
}

@keyframes sequence2 {
  0% {
    left: 0%;
    width: 122px;
  }
  100% {
    left: 40%;
    width: 122px;
  }
}

@keyframes bsequence2 {
  0% {
    left: 0%;
    width: 60px;
  }
  100% {
    left: 50%;
    width: 60px;
  }
}

@keyframes sequence3 {
  0% {
    left: 0%;
    width: 80px;
  }
  100% {
    left: 30%;
    width: 80px;
  }
}
@keyframes sequence4 {
  0% {
    left: 0%;
    width: 150px;
  }
  100% {
    left:25%;
    width: 150px;
  }
}
@keyframes sequence5 {
  0% {
    left: 0%;
    width: 18px;
  }
  100% {
    left: 80%;
    width: 18px;
  }
}

@keyframes sequence6 {
  0% {
    left: 0%;
    width: 60px;
  }
  100%{
    left: 55%;
    width: 60px;
  }
}

@keyframes bsequence7 {
  0% {
    right: 0%;
    width: 42px;
  }
  100%{
    right: 45%;
  }
}

@keyframes sequence7 {
  0% {
    left: 0%;
    width: 122px;
  }
  100% {
    left: 48%;
    width: 122px;
  }
}

@keyframes bsequence8 {
  0% {
    left: 0%;
    width: 122px;
  }
  100% {
    left: 55%;
    width: 122px;
  }
}

@keyframes sequence8 {
  0% {
    left: 0%;
    width: 42px;
  }
  100% {
    left: 33%;
    width: 42px;
  }
}
@keyframes sequence9 {
  0% {
    left: 0%;
    width: 100px;
  }
  100% {
    left:64%;
    width: 100px;
  }
}
@keyframes sequence10 {
  0% {
    left: 0%;
    width: 18px;
  }
  100% {
    left: 72%;
    width: 18px;
  }
}

  </style>
  <div id="loader">
  <ul>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>

    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>

    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>

    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
  <div class="container">
    <div class="row">
      <div class="hero-a__col anim-ready left--">
        <<?= $data['h_el']; ?> class="type2 hero-a__title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        <div class="hero-a__content type0"><?= apply_filters('the_content', $data['body_copy']); ?></div>
        <?php if (!empty($data['cta'])) : ?>
          <p>
            <?php
              $data['cta']['classes'] = array('button--primary', 'blue-button--');
              element('button', $data['cta']);
            ?>
          </p>
        <?php endif; ?>
      </div>
      <?php if (!empty($data['image_id'])) : ?>
        <div class="hero-a__col right-- hero-a__image">
          <?php element('image', [
            'id' => $data['image_id']
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
