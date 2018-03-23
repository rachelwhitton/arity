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
}

.right li {
  left: auto;
  right: 0;
}

#loader li:nth-child(1) {
  top: 18px;
  animation: sequence1 10s ease-in-out infinite 1s;
}
/* #loader li:nth-child(2) {
  top: 68px;
  animation: sequence2 10s ease-in-out infinite 1.4s;
} */
/* #loader li:nth-child(3) {
  top: 118px;
  animation: sequence3 10s ease-in-out infinite 1.8s;
} */
#loader li:nth-child(4) {
  top: 168px;
  animation: sequence4 10s ease-in-out infinite 2.2s;
}
/* #loader li:nth-child(5) {
  top: 218px;
  animation: sequence5 10s ease-in-out infinite 2.4s;
} */

#loader li:nth-child(6) {
  top: 18px;
  animation: sequence6 10s ease-in-out infinite 3s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
/* #loader li:nth-child(7) {
  top: 68px;
  animation: sequence7 10s ease-in-out infinite 2s;
} */
#loader li:nth-child(8) {
  top: 118px;
  animation: sequence8 10s ease-in-out infinite 4s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
/* #loader li:nth-child(9) {
  top: 168px;
  animation: sequence9 10s ease-in-out infinite 2s;
} */
#loader li:nth-child(10) {
  top: 218px;
  animation: sequence10 10s ease-in-out infinite 3s;
}

#loader li:nth-child(11) {
  top: 268px;
  animation: sequence1 10s ease-in-out infinite 1.1s;
  background-color: rgba(118,134,147,0.2);
}
/* #loader li:nth-child(12) {
  top: 68px;
  animation: sequence2 10s ease-in-out infinite 0.8s;
  background-color: rgba(118,134,147,0.2);
} */
/* #loader li:nth-child(13) {
  top: 468px;
  animation: sequence3 10s ease-in-out infinite 0.5s;
  background-color: rgba(118,134,147,0.2);
} */
#loader li:nth-child(14) {
  top: 418px;
  animation: sequence4 10s ease-in-out infinite 4.4s;
  background-color: rgba(118,134,147,0.2);
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
/* #loader li:nth-child(15) {
  top: 418px;
  animation: sequence5 10s ease-in-out infinite 1.4s;
  background-color: rgba(118,134,147,0.2);
} */

#loader li:nth-child(16) {
  top: 268px;
  animation: sequence6 10s ease-in-out 3s;
  background-color: rgba(118,134,147,0.2);
}
#loader li:nth-child(17) {
  top: 368px;
  animation: sequence7 10s ease-in-out 5.1s;
  background-color: rgba(118,134,147,0.2);
}
/* #loader li:nth-child(18) {
  top: 168px;
  animation: sequence8 10s ease-in-out 7.8s;
  background-color: rgba(118,134,147,0.2);
} */
#loader li:nth-child(19) {
  top: 318px;
  animation: sequence9 10s ease-in-out 1.4s;
  background-color: rgba(118,134,147,0.2);
}
/* #loader li:nth-child(20) {
  top: 318px;
  animation: sequence10 10s ease-in-out 6.2s;
  background-color: rgba(118,134,147,0.2);
} */

#loader li:nth-child(21) {
  top: 18px;
  width: 18px;
  animation: sequence1 10s ease-in-out infinite 3.3s;
}
/* #loader li:nth-child(22) {
  top: 368px;
  width: 18px;
  animation: sequence2 10s ease-in-out infinite 6.1s;
} */
#loader li:nth-child(23) {
  top: 118px;
  width: 18px;
  animation: sequence3 10s ease-in-out infinite 7.4s;
}
#loader li:nth-child(24) {
  top: 468px;
  width: 18px;
  animation: sequence4 10s ease-in-out infinite 8.6s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
/* #loader li:nth-child(25) {
  top: 218px;
  width: 18px;
  animation: sequence5 10s ease-in-out infinite 9.7s;
} */


#loader li:nth-child(26) {
  left: auto;
  right: 0;
  top: 18px;
  animation: bsequence1 10s ease-in-out infinite 1s;
}
/* #loader li:nth-child(27) {
  left: auto;
  right: 0;
  top: 68px;
  animation: bsequence2 10s ease-in-out infinite 0.1s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
#loader li:nth-child(28) {
  left: auto;
  right: 0;
  top: 118px;
  animation: bsequence7 10s ease-in-out infinite 0.6s;
} */
/* #loader li:nth-child(29) {
  left: auto;
  right: 0;
  top: 168px;
  animation: bsequence8 10s ease-in-out infinite 1s;
} */
#loader li:nth-child(30) {
  left: auto;
  right: 0;
  top: 468px;
  animation: bsequence1 10s ease-in-out infinite 1.5s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}


#loader li:nth-child(31) {
  left: auto;
  right: 0;
  top: 18px;
  animation: bsequence2 10s ease-in-out infinite 2s;
}
/* #loader li:nth-child(32) {
  left: auto;
  right: 0;
  top: 68px;
  animation: bsequence7 10s ease-in-out infinite 2.2s;
} */
#loader li:nth-child(33) {
  left: auto;
  right: 0;
  top: 118px;
  animation: bsequence8 10s ease-in-out infinite 1.3s;
}
/* #loader li:nth-child(34) {
  left: auto;
  right: 0;
  top: 168px;
  animation: bsequence1 10s ease-in-out infinite 1.5s;
} */
#loader li:nth-child(35) {
  left: auto;
  right: 0;
  top: 218px;
  animation: bsequence2 10s ease-in-out infinite 1.6s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}

/* #loader li:nth-child(36) {
  top: 18px;
  animation: bsequence7 10s ease-in-out infinite 8.7s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
} */

#loader li:nth-child(37) {
  top: 268px;
  animation: bsequence8 10s ease-in-out infinite 7.8s;
  background-color: rgba(118,134,147,0.2);
}
#loader li:nth-child(38) {
  top: 468px;
  animation: bsequence1 10s ease-in-out infinite 6.5s;
  background-color: rgba(118,134,147,0.2);
}
/* #loader li:nth-child(39) {
  top: 468px;
  animation: bsequence2 10s ease-in-out infinite 5.7s;
  background-color: rgba(118,134,147,0.2);
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
} */
#loader li:nth-child(40) {
  top: 418px;
  animation: bsequence7 10s ease-in-out infinite 3s;
  background-color: rgba(118,134,147,0.2);
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
#loader li:nth-child(41) {
  top: 418px;
  animation: bsequence8 10s ease-in-out infinite 2.3s;
  background-color: rgba(118,134,147,0.2);
}
/*  */

/* #loader li:nth-child(42) {
  top: 468px;
  animation: sequence2 10s ease-in-out infinite 1.4s;
} */
#loader li:nth-child(43) {
  top: 518px;
  animation: sequence3 10s ease-in-out infinite 1.8s;
}
/* #loader li:nth-child(44) {
  top: 568px;
  animation: sequence4 10s ease-in-out infinite 2.2s;
} */
#loader li:nth-child(45) {
  top: 618px;
  animation: sequence5 10s ease-in-out infinite 2.4s;
}

/* #loader li:nth-child(46) {
  top: 618px;
  animation: sequence6 10s ease-in-out infinite 3s;
  background: url("../dots.png") repeat 16px -4px;
  background-size: 116px;
}
#loader li:nth-child(47) {
  top: 468px;
  animation: sequence7 10s ease-in-out infinite 2s;
} */
#loader li:nth-child(48) {
  top: 518px;
  animation: sequence8 10s ease-in-out infinite 4s;
}
#loader li:nth-child(49) {
  top: 568px;
  animation: sequence9 10s ease-in-out infinite 2s;
}
/* #loader li:nth-child(50) {
  top: 518px;
  animation: sequence10 10s ease-in-out infinite 3s;
} */

#loader li:nth-child(51) {
  top: 418px;
  animation: sequence9 10s ease-in-out 3s;
  background-color: rgba(118,134,147,0.2);
}

#loader li:nth-child(51) {
  top: 618px;
  animation: sequence4 10s ease-in-out 4s;
  background-color: rgba(118,134,147,0.2);
}

/* #loader li:nth-child(53) {
  top: 518px;
  animation: sequence9 10s ease-in-out 5s;
  background-color: rgba(118,134,147,0.2);
} */

/* #loader li {
  left: 800px !important;
  right: auto !important;
  width: 120px !important;
} */


  @keyframes sequence1 {
  0% {
    left: 0%;
    width: 46px;
  }
  40%{
    left: 20%;
    width: 46px;
  }
  60%{
    left: 90%;
    width: 46px;
  }
  100% {
    left: 130%;
    width: 46px;
  }
}

@keyframes bsequence1 {
  0% {
    right: 0%;
    width: 46px;
  }
  40%{
    right: 20%;
    width: 46px;
  }
  60%{
    right: 40%;
    width: 46px;
  }
  100% {
    right: 130%;
    width: 46px;
  }
}

@keyframes sequence2 {
  0% {
    left: 0%;
    width: 122px;
  }
  25% {
    left: 10%;
    width: 122px;
  }
  75% {
    left: 40%;
    width: 122px;
  }
  100% {
    left: 130%;
    width: 122px;
  }
}

@keyframes bsequence2 {
  0% {
    left: 0%;
    width: 60px;
  }
  25% {
    left: 40%;
    width: 60px;
  }
  75% {
    left: 50%;
    width: 60px;
  }
  100% {
    left: 130%;
    width: 60px;
  }
}

@keyframes sequence3 {
  0% {
    left: 0%;
    width: 80px;
  }
  50% {
    left: 30%;
    width: 80px;
  }
  100% {
    width: 80px;
    left: 130%;
  }
}
@keyframes sequence4 {
  0% {
    left: 0%;
    width: 150px;
  }
  50% {
    left:85%;
    width: 150px;
  }
  100% {
    width: 150px;
    left: 130%;
  }
}
@keyframes sequence5 {
  0% {
    left: 0%;
    width: 18px;
  }
  50% {
    left: 80%;
    width: 18px;
  }
  100% {
    left: 130%;
    width: 18px;
  }
}

@keyframes sequence6 {
  0% {
    left: 0%;
    width: 60px;
  }
  40%{
    left: 10%;
    width: 60px;
  }
  60%{
    left: 55%;
    width: 60px;
  }
  100% {
    left: 130%;
    width: 60px;
  }
}

@keyframes bsequence7 {
  0% {
    right: 0%;
    width: 42px;
  }
  40%{
    right: 10%;
  }
  60%{
    right: 45%;
  }
  100% {
    right: 130%;
    width: 42px;
  }
}

@keyframes sequence7 {
  0% {
    left: 0%;
    width: 122px;
  }
  25% {
    left: 15%;
    width: 122px;
  }
  75% {
    left: 48%;
    width: 122px;
  }
  100% {
    left: 130%;
    width: 122px;
  }
}

@keyframes bsequence8 {
  0% {
    left: 0%;
    width: 122px;
  }
  25% {
    left: 28%;
    width: 122px;
  }
  75% {
    left: 55%;
    width: 122px;
  }
  100% {
    left: 130%;
    width: 122px;
  }
}

@keyframes sequence8 {
  0% {
    left: 0%;
    width: 42px;
  }
  50% {
    left: 33%;
    width: 42px;
  }
  100% {
    width: 42px;
    left: 130%;
  }
}
@keyframes sequence9 {
  0% {
    left: 0%;
    width: 100px;
  }
  50% {
    left:64%;
    width: 100px;
  }
  100% {
    width: 100px;
    left: 130%;
  }
}
@keyframes sequence10 {
  0% {
    left: 0%;
    width: 18px;
  }
  50% {
    left: 72%;
    width: 18px;
  }
  100% {
    left: 130%;
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
