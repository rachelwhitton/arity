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

  #loader {
    display: none;
    transition: all 1.4s;
  }

  .animate,
  .anim-ready {
    position: relative;
    background-image: none !important;
  }
  @media screen and (min-width: 481px) {

    .animate .hero-a__col.left-- {
      background-image: -webkit-linear-gradient(left, rgba(238,238,238,0.00) 0%, #f7f7f7 20%, #f7f7f7 25%, rgba(255,255,255,0.00) 90%);
      background-image: -o-linear-gradient(left, rgba(238,238,238,0.00) 0%, #f7f7f7 20%, #f7f7f7 25%, rgba(255,255,255,0.00) 90%);
      background-image: linear-gradient(to right, rgba(238,238,238,0.00) 0%, #f7f7f7 20%, #f7f7f7 25%, rgba(255,255,255,0.00) 90%);
    }

    .animate #loader {
      display: block;
      position: relative;
      position: absolute;
      height: 650px;
      width: 100%;
      left: 0;
      top: 0;
      /* background-color: #00ff00; */
      list-style: none;
    }

    .animate #loader li {
      position: absolute;
      width: 40px;
      height: 18px;
      /* margin-top:20px; */
      background-color: rgba(118,134,147,0.05);
      /* bottom: 0; */
      border-radius: 18px;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      left: 0;
      top: 0;
      opacity: 0;
    }

    .right li {
      left: auto;
      right: 0;
    }



    .animate #loader li:nth-child(1) {
      top: 468px;
      left: auto;
      right: 0;
      animation: bsequence2 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(2) {
      top: 168px;
      animation: sequence4 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.8s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(3) {
      top: 518px;
      animation: sequence11 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
    }

    .animate #loader li:nth-child(4) {
      top: 68px;
      animation: sequence8 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 1.5s;
      /* animation: sequence8 1.4s cubic-bezier(1, 0.27, 0.25, 1) 1 1s; */
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
    }

    .animate #loader li:nth-child(5) {
      top: 218px;
      animation: sequence10 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.5s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(6) {
      top: 318px;
      animation: sequence12 1.4s cubic-bezier(1, 0.27, 0.25, 1) 1 1s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
    }

    .animate #loader li:nth-child(7) {
      top: 418px;
      animation: sequence14 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 1s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
    }


    .animate #loader li:nth-child(8) {
      top: 318px;
      animation: sequence6 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.8s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
    }
    .animate #loader li:nth-child(9) {
      /* top: 368px;
      animation: sequence7 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.1s;
      -webkit-animation-fill-mode: forwards;
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2); */

      top: 268px;
      animation: sequence15 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.1s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
      transform: translateX(50px);
      display: none;
    }

    .animate #loader li:nth-child(10) {
      top: 318px;
      animation: sequence9 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.4s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
    }


    .animate #loader li:nth-child(11) {
      top: 518px;
      width: 18px;
      animation: sequence1 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.3s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(12) {
      top: 68px;
      width: 18px;
      animation: sequence3 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.8s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }
    .animate #loader li:nth-child(13) {
      top: 518px;
      width: 18px;
      animation: sequence4 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.6s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
    }


    .animate #loader li:nth-child(14) {
      left: auto;
      right: 0;
      top: 518px;
      animation: bsequence11 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(15) {
      /* left: auto;
      right: 0; */
      top: 468px;
      animation: sequence7 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.5s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      /* background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px; */
    }


    .animate #loader li:nth-child(16) {
      left: auto;
      right: 0;
      top: 518px;
      animation: bsequence12 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 1s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(17) {
      left: auto;
      right: 0;
      top: 118px;
      animation: bsequence8 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.3s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
    }

    .animate #loader li:nth-child(18) {
      left: auto;
      right: 0;
      top: 218px;
      animation: bsequence2 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.6s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background: url("https://dev.site.arity.vsadev.com/wp-content/themes/arity/dist/img/dots_60.png") repeat 16px -4px;
      background-size: 116px;
    }

    .animate #loader li:nth-child(19) {
      top: 268px;
      left: auto;
      right: 0;
      animation: bsequence9 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.8s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
    }
    .animate #loader li:nth-child(20) {
      top: 468px;
      left: auto;
      right: 0;
      animation: bsequence1 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0.5s;
      -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
      animation-fill-mode: forwards;
      background-color: rgba(118,134,147,0.2);
    }



    .booyah #loader {
      opacity: 0 !important;
    }


    .booyah #loader li:nth-child(1) {
      animation: brrsequence2 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(2) {
      animation: rrsequence4 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(3) {
      animation: rrsequence11 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(4) {
      animation: rrsequence8 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(5) {
      animation: rrsequence10 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(6) {
      animation: rrsequence12 1.4s cubic-bezier(1, 0.27, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(7) {
      animation: rrsequence14 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(8) {
      animation: rrsequence6 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }
    .booyah #loader li:nth-child(9) {
      animation: rrsequence15 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(10) {
      animation: rrsequence9 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(11) {
      animation: rrsequence1 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(12) {
      animation: rrsequence3 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(13) {
      animation: rrsequence4 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(14) {
      animation: brrsequence11 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(15) {
      animation: rrsequence7 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(16) {
      animation: brrsequence12 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(17) {
      animation: brrsequence8 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(18) {
      animation: brrsequence2 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

    .booyah #loader li:nth-child(19) {
      animation: brrsequence9 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }
    .booyah #loader li:nth-child(20) {
      animation: brrsequence1 1.4s cubic-bezier(0.25, 0.1, 0.25, 1) 1 0s;
    }

}


@keyframes sequence1 {
  0% {
    left: 10%;
    opacity: 0;
  }
  100%{
    left: 30%;
    opacity: 1;
  }
}

@keyframes bsequence1 {
  0% {
    right: 40%;
    width: 80px;
    opacity: 0;
  }
  100%{
    right: 52%;
    width: 80px;
    opacity: 1;
  }
}

@keyframes sequence2 {
  0% {
    left: 30%;
    width: 122px;
    opacity: 0;
  }
  100% {
    left: 40%;
    width: 122px;
    opacity: 1;
  }
}

@keyframes bsequence2 {
  0% {
    right: 50%;
    width: 60px;
    opacity: 0;
  }
  100% {
    right: 88%;
    width: 60px;
    opacity: 1;
  }
}

@keyframes sequence3 {
  0% {
    left: 10%;
    width: 80px;
    opacity: 0;
  }
  100% {
    left: 30%;
    width: 80px;
    opacity: 1;
  }
}
@keyframes sequence4 {
  0% {
    left: 8%;
    width: 150px;
    opacity: 0;
  }
  100% {
    left: 18%;
    width: 150px;
    opacity: 1;
  }
}
@keyframes sequence5 {
  0% {
    left: 30%;
    width: 18px;
    opacity: 0;
  }
  100% {
    left: 80%;
    width: 18px;
    opacity: 1;
  }
}

@keyframes sequence6 {
  0% {
    left: 35%;
    width: 60px;
    opacity: 0;
  }
  100%{
    left: 55%;
    width: 60px;
    opacity: 1;
  }
}

@keyframes bsequence7 {
  0% {
    right: 10%;
    width: 42px;
    opacity: 0;
  }
  100%{
    right: 45%;
    opacity: 1;
  }
}

@keyframes sequence7 {
  0% {
    left: 30%;
    width: 18px;
    opacity: 0;
  }
  100% {
    left: 49%;
    width: 18px;
    opacity: 1;
  }
}

@keyframes bsequence8 {
  0% {
    right: -10%;
    width: 122px;
    opacity: 0;
  }
  100% {
    right: 15%;
    width: 122px;
    opacity: 1;
  }
}

@keyframes sequence8 {
  0% {
    left: 20%;
    width: 95px;
    opacity: 0;
  }
  100% {
    left: 33%;
    width: 95px;
    opacity: 1;

  }
}
@keyframes sequence9 {
  0% {
    left: 85%;
    width: 100px;
    opacity: 0;
  }
  100% {
    left: 95%;
    width: 100px;
    opacity: 1;
  }
}
@keyframes bsequence9 {
  0% {
    right: 85%;
    width: 100px;
    opacity: 0;
  }
  100% {
    right: 95%;
    width: 100px;
    opacity: 1;
  }
}
@keyframes sequence10 {
  0% {
    left: -10%;
    width: 18px;
    opacity: 0;
  }
  50% {
    left: 15%;
    width: 18px;
    opacity: 1;
  }
  100% {
    left: 16%;
    width: 18px;
    opacity: 1;
  }
}

@keyframes sequence11 {
  0% {
    left: 60%;
    width: 60px;
    opacity: 0;
  }
  100%{
    left: 85%;
    width: 60px;
    opacity: 1;
  }
}

@keyframes bsequence11 {
  0% {
    right: -10%;
    width: 46px;
    opacity: 0;
  }
  100%{
    right: 10%;
    width: 46px;
    opacity: 1;
  }
}

@keyframes sequence12 {
  0% {
    left: 70%;
    width: 18px;
    opacity: 0;
  }
  100% {
    left: 60%;
    width: 18px;
    opacity: 0.5;
  }
}

@keyframes bsequence12 {
  0% {
    right: 65%;
    width: 60px;
    opacity: 0;
  }
  100% {
    right: 80%;
    width: 60px;
    opacity: 1;
  }
}

@keyframes sequence14 {
  0% {
    left: 80%;
    width: 100px;
    opacity: 0;
  }
  100% {
    left: 90%;
    width: 100px;
    opacity: 1;
  }
}

@keyframes sequence15 {
  0% {
    left: 72%;
    width: 118px;
    opacity: 0;
  }
  100% {
    left: 79%;
    opacity: 1;
    width: 118px;
  }
}

@keyframes rrsequence1 {
  0%{
    left: 30%;
    opacity: 1;
  }
  100% {
    left: 10%;
    opacity: 0;
  }
}

@keyframes brrsequence1 {
  0%{
    right: 52%;
    width: 80px;
    opacity: 1;
  }
  100% {
    right: 40%;
    width: 80px;
    opacity: 0;
  }
}

@keyframes rrsequence2 {
  0% {
    left: 40%;
    width: 122px;
    opacity: 1;
  }
  100% {
    left: 30%;
    width: 122px;
    opacity: 0;
  }
}

@keyframes brrsequence2 {
  0% {
    right: 88%;
    width: 60px;
    opacity: 1;
  }
  100% {
    right: 50%;
    width: 60px;
    opacity: 0;
  }
}

@keyframes rrsequence3 {
  0% {
    left: 30%;
    width: 80px;
    opacity: 1;
  }
  100% {
    left: 10%;
    width: 80px;
    opacity: 0;
  }
}
@keyframes rrsequence4 {
  0% {
    left: 18%;
    width: 150px;
    opacity: 1;
  }
  100% {
    left: 8%;
    width: 150px;
    opacity: 0;
  }
}
@keyframes rrsequence5 {
  0% {
    left: 80%;
    width: 18px;
    opacity: 1;
  }
  100% {
    left: 30%;
    width: 18px;
    opacity: 0;
  }
}

@keyframes rrsequence6 {
  0%{
    left: 55%;
    width: 60px;
    opacity: 1;
  }
  100% {
    left: 35%;
    width: 60px;
    opacity: 0;
  }
}

@keyframes brrsequence7 {
  0%{
    right: 45%;
    opacity: 1;
  }
  100% {
    right: 10%;
    width: 42px;
    opacity: 0;
  }
}

@keyframes rrsequence7 {
  0% {
    left: 49%;
    width: 18px;
    opacity: 1;
  }
  100% {
    left: 30%;
    width: 18px;
    opacity: 0;
  }
}

@keyframes brrsequence8 {
  0% {
    right: 15%;
    width: 122px;
    opacity: 1;
  }
  100% {
    right: -10%;
    width: 122px;
    opacity: 0;
  }
}

@keyframes rrsequence8 {
  0% {
    left: 33%;
    width: 95px;
    opacity: 1;

  }
  100% {
    left: 20%;
    width: 95px;
    opacity: 0;
  }
}
@keyframes rrsequence9 {
  0% {
    left: 95%;
    width: 100px;
    opacity: 1;
  }
  100% {
    left: 85%;
    width: 100px;
    opacity: 0;
  }
}
@keyframes brrsequence9 {
  0% {
    right: 95%;
    width: 100px;
    opacity: 1;
  }
  100% {
    right: 85%;
    width: 100px;
    opacity: 0;
  }
}
@keyframes rrsequence10 {
  0% {
    left: 16%;
    width: 18px;
    opacity: 1;
  }
  50% {
    left: 15%;
    width: 18px;
    opacity: 1;
  }
  100% {
    left: -10%;
    width: 18px;
    opacity: 0;
  }
}

@keyframes rrsequence11 {
  0%{
    left: 85%;
    width: 60px;
    opacity: 1;
  }
  100% {
    left: 60%;
    width: 60px;
    opacity: 0;
  }
}

@keyframes brrsequence11 {
  0%{
    right: 10%;
    width: 46px;
    opacity: 1;
  }
  100% {
    right: -10%;
    width: 46px;
    opacity: 0;
  }
}

@keyframes rrsequence12 {
  0% {
    left: 60%;
    width: 18px;
    opacity: 0.5;
  }
  100% {
    left: 70%;
    width: 18px;
    opacity: 0;
  }
}

@keyframes brrsequence12 {
  0% {
    right: 80%;
    width: 60px;
    opacity: 1;
  }
  100% {
    right: 65%;
    width: 60px;
    opacity: 0;
  }
}

@keyframes rrsequence14 {
  0% {
    left: 90%;
    width: 100px;
    opacity: 1;
  }
  100% {
    left: 80%;
    width: 100px;
    opacity: 0;
  }
}

@keyframes rrsequence15 {
  0% {
    left: 79%;
    opacity: 1;
    width: 118px;
  }
  100% {
    left: 72%;
    width: 118px;
    opacity: 0;
  }
}

  </style>
  <ul id="loader">
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
