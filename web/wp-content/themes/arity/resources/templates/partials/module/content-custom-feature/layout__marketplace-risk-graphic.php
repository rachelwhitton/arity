<?php
/*
  Layout Name:				Marketplace Risk graphic
  Description:        Custom layout for the Marketplace Risk landing page
  Last Updated:       05/20/2019
  Since:              2.3.0
*/
 ?>
 
<style>
	#custom-feature__marketplace-risk-graphic_mobile {
		display: block;
		position: relative;
		width: 100%;
		height: 0;
		padding: 0;
		padding-bottom: 100%;
		/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#002950+0,011c2c+100 */
		background: #002950; /* Old browsers */
	  background: -webkit-linear-gradient(#002950 0%, #011c2c 100%);
	  background: -o-linear-gradient(#002950 0%, #011c2c 100%);
  	background: linear-gradient(#002950 0%, #011c2c 100%); /* FF3.6-15  |  Chrome10-25,Safari5.1-6  |  W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#002950', endColorstr='#011c2c',GradientType=0 ); /* IE6-9 */
	}
	#custom-feature__marketplace-risk-graphic {
		display: none;
		width: 100%;
		height: auto;
		background: #002950;
	  background: -webkit-linear-gradient(#002950 0%, #011c2c 100%);
	  background: -o-linear-gradient(#002950 0%, #011c2c 100%);
  	background: linear-gradient(#002950 0%, #011c2c 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#002950', endColorstr='#011c2c',GradientType=0 );
	}
	@media screen and (min-width: 768px) {
		#custom-feature__marketplace-risk-graphic_mobile {
			display: none;
		}
		#custom-feature__marketplace-risk-graphic {
			display: block;
		}
	}
	#mr-analytics-graphic_mobile {
		position: absolute;
		height: 100%;
		width: 100%;
		left: 0;
		top: 0;
		/*position: relative;
		width: 480px;
		max-width: 100%;
		min-width: 480px;*/
		margin: 32px 0 0;
	}
	#mr-analytics-head-graphic {
		opacity: 0;
		position: relative;
		width: 468px;
		margin: 66px auto 32px;
		transition: all 0.8s ease-in-out;
	}
	#mr-analytics-head-graphic.visible {
		opacity: 1;
	}
	#mr-analytics-body-graphic {
		position: relative;
		width: 720px;
		margin: 0 auto 93px;
	}
</style>

<!-- Marketplace Risk Analytics Graphic MOBILE -->
<!-- For mobile SVG placement, used padding-bottom "hack" → https://css-tricks.com/scale-svg/#article-header-id-10 -->
<!-- padding-bottom calculation → 978/480 = 203.75  -->
<div class="container" id="custom-feature__marketplace-risk-graphic_mobile" style="padding-bottom: 203.75%">
	<!-- <div class="row"> -->

		<svg id="mr-analytics-graphic_mobile" width="480px" height="978px" viewBox="0 0 480 978" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<defs>
				<style>
					#arrow-head-1_mobile, #arrow-head-2_mobile, #arrow-head-3_mobile, #animated-270deg-arc_mobile {
						opacity: 0;
					}
					#mr-analytics-head-graphic_mobile, #rectangle-1-group_mobile, #rectangle-2-group_mobile, #rectangle-3-group_mobile, #rectangle-4-group_mobile, .rectangle-1-blurb, .rectangle-2-blurb, .rectangle-3-blurb, .rectangle-4-blurb {
						opacity: 0;
						transition: all 0.8s ease-in-out;
					}
					#mr-analytics-head-graphic_mobile.visible, #rectangle-1-group_mobile.visible, #rectangle-2-group_mobile.visible, #rectangle-3-group_mobile.visible, #rectangle-4-group_mobile.visible, .rectangle-1-blurb.visible, .rectangle-2-blurb.visible, .rectangle-3-blurb.visible, .rectangle-4-blurb.visible {
						opacity: 1;
					}
				</style>

				<clipPath id="lineClip1_mobile">
					<rect id="lineRect1_mobile" width="4" height="0" x="448" y="222">
				</clipPath>
				<clipPath id="lineClip2_mobile">
					<rect id="lineRect2_mobile" width="4" height="0" x="448" y="418">
				</clipPath>
				<clipPath id="lineClip3_mobile">
					<rect id="lineRect3_mobile" width="4" height="0" x="448" y="609">
				</clipPath>
			</defs>
		    <!-- Generator: Sketch 53.2 (72643) - https://sketchapp.com -->
		    <title>Marketplace Risk Analytics Graphic - Mobile</title>
		    <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <g id="Key_Graphic_Mobile" transform="translate(0.000000, -283.000000)">
		            <g id="mr-analytics-graphic_mobile__wrapper" transform="translate(0.000000, 284.000000)">

		            		<!-- RECTANGLES MOBILE -->
		                <text id="Predictive-maintenan" class="rectangle-1-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="261" y="274">Predictive </tspan>
		                    <tspan x="261" y="302">maintenance</tspan>
		                </text>
		                <text id="Predict-risk-of-new" class="rectangle-1-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="31" y="275">Predict risk of new or </tspan>
		                    <tspan x="31" y="303">like-new members</tspan>
		                </text>
		                <g id="rectangle-1-group_mobile">
			                <polygon id="rectangle-1_mobile" fill="#098189" fill-rule="nonzero" points="0 176 480 176 480 236 0 236"></polygon>
			                <g id="arrow-oval-1_mobile" transform="translate(437.000000, 194.000000)" fill="#FFFFFF" fill-rule="nonzero">
			                    <circle id="Oval-2" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
			                    <circle id="Oval-2" cx="12.5" cy="12.5" r="5.5"></circle>
			                </g>
			                <text id="rectangle-1-title_mobile" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
			                    <tspan x="31" y="217">Pre-driving risk mitigation</tspan>
			                </text>
			               </g>
		                <text id="Collision-analytics-Copy" class="rectangle-2-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="261" y="468">Collision analytics</tspan>
		                </text>
		                <text id="Driving-behavior-ana-Copy" class="rectangle-2-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="35" y="468">Driving behavior </tspan>
		                    <tspan x="35" y="496">analytics</tspan>
		                </text>
		                <g id="rectangle-2-group_mobile">
			                <polygon id="rectangle-2_mobile" fill="#098189" fill-rule="nonzero" points="0 369 480 369 480 429 0 429"></polygon>
			                <g id="arrow-oval-2_mobile" transform="translate(437.000000, 387.000000)" fill="#FFFFFF" fill-rule="nonzero">
			                    <circle id="Oval-2" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
			                    <circle id="Oval-2" cx="12.5" cy="12.5" r="5.5"></circle>
			                </g>
		                	<text id="rectangle-2-title_mobile" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
		                    <tspan x="31" y="410">Reduce loss costs</tspan>
		                	</text>
			              </g>
		                <text id="Shared-vehicle-suppl-Copy" class="rectangle-3-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="259" y="662">Shared vehicle </tspan>
		                    <tspan x="259" y="690">supply optimization</tspan>
		                </text>
		                <text id="Personalized-driver-Copy" class="rectangle-3-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="32" y="662">Personalized driver </tspan>
		                    <tspan x="32" y="690">and rider incentives</tspan>
		                </text>
		                <g id="rectangle-3-group_mobile">
			                <polygon id="rectangle-3_mobile" fill="#098189" fill-rule="nonzero" points="0 565 480 565 480 625 0 625"></polygon>
			                <g id="arrow-oval-3_mobile" transform="translate(437.000000, 582.000000)" fill="#FFFFFF" fill-rule="nonzero">
			                    <circle id="Oval-2" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
			                    <circle id="Oval-2" cx="12.5" cy="12.5" r="5.5"></circle>
			                </g>
			                <text id="rectangle-3-title_mobile" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
			                    <tspan x="31" y="604">Increase adoption</tspan>
			                </text>
			              </g>
		                <text id="New-market-mobility-Copy" class="rectangle-4-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="264" y="857">New market </tspan>
		                    <tspan x="264" y="885">mobility insights</tspan>
		                </text>
		                <text id="Multimodal-demand-pr-Copy" class="rectangle-4-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="31" y="857">Multimodal demand </tspan>
		                    <tspan x="31" y="885">predictions</tspan>
		                </text>
		                <g id="rectangle-4-group_mobile">
			                <polygon id="rectangle-4_mobile" fill="#098189" fill-rule="nonzero" points="0 759 480 759 480 819 0 819"></polygon>
			                <g id="arrow-oval-4_mobile" transform="translate(437.000000, 778.000000)" fill="#FFFFFF" fill-rule="nonzero">
			                    <circle id="oval-outer-4_mobile" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
			                    <circle id="oval-inner-4_mobile" cx="12.5" cy="12.5" r="5.5"></circle>
			                </g>
			                <text id="rectangle-4-title_mobile" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
			                    <tspan x="31" y="799">Diversify services</tspan>
			                </text>
			              </g>

			              <!-- ARROWS MOBILE -->
		                <polyline id="arrow-head-3_mobile" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill-rule="nonzero" transform="translate(430.000000, 791.000000) rotate(-180.000000) translate(-430.000000, -791.000000) " points="426 789 430 793 434 789"></polyline>
		                <path d="M430,791 C430,801.49341 438.50659,810 449,810 L449,810 C459.49341,810 468,801.49341 468,791 C468,780.50659 459.49341,772 449,772" id="animated-270deg-arc_mobile" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill-rule="nonzero"></path>
		                <g id="LineReveal3_mobile" clip-path="url(#lineClip3_mobile)">
		                	<path d="M449,609 L449,772" id="arrow-line-3_mobile" stroke="#FFFFFF" stroke-width="2" fill="#D8D8D8" fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,4"></path>
		                </g>
		                <polyline id="arrow-head-2_mobile" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill-rule="nonzero" points="445 572 449.5 577 454 572"></polyline>
		                <g id="LineReveal2_mobile" clip-path="url(#lineClip2_mobile)">
		                	<path d="M449,418 L449,572" id="arrow-line-2_mobile" stroke="#FFFFFF" stroke-width="2" fill="#D8D8D8" fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,4"></path>
		                </g>
		                <polyline id="arrow-head-1_mobile" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill-rule="nonzero" points="445 379 449.5 384 454 379"></polyline>
		                <g id="LineReveal1_mobile" clip-path="url(#lineClip1_mobile)">
		                	<path d="M449,222 L449,380" id="arrow-line-1_mobile" stroke="#FFFFFF" stroke-width="2" fill="#D8D8D8" fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,4"></path>
		                </g>

		                <!-- HEADER GRAPHIC - MOBILE -->
		                <g id="mr-analytics-head-graphic_mobile" transform="translate(39.000000, 0.000000)">
		                    <g id="plus_mobile" transform="translate(187.000000, 40.000000)" fill-rule="nonzero" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		                        <g id="Group">
		                            <path d="M14,0 L14,28" id="Path-4"></path>
		                            <path d="M28,14.6086957 L0,14.6086957" id="Path-4"></path>
		                        </g>
		                    </g>
		                    <text id="driver-analytics-graphic-text" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="32" fill="#FFFFFF">
		                        <tspan x="14.5917969" y="126">Driver analytics</tspan>
		                    </text>
		                    <g id="driver-analytics-graphic" transform="translate(36.000000, 0.000000)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		                        <path d="M59.0323729,71.0424576 C58.9188136,70.7916102 58.8044068,70.7000847 58.6484746,70.5899153 C57.4933898,69.785678 54.2433898,67.9399153 50.4264407,67.9178814 L50.4264407,67.915339 C50.4154237,67.915339 50.4035593,67.9170339 50.3925424,67.9170339 C50.3815254,67.9170339 50.3705085,67.915339 50.3586441,67.915339 L50.3586441,67.9178814 C46.5425424,67.9399153 43.2925424,69.785678 42.1374576,70.5899153 C41.9798305,70.7000847 41.8671186,70.7916102 41.7527119,71.0424576 C41.660339,71.2483898 41.5738983,71.6661864 41.5738983,71.6661864 L41.5738983,75.1229661 L59.2120339,75.1229661 L59.2120339,71.6661864 C59.2120339,71.6661864 59.1247458,71.2483898 59.0323729,71.0424576 Z M50.1815254,64.2873729 L50.5357627,64.2873729 C52.4967797,64.2873729 54.0857627,62.6975424 54.1722034,60.7382203 L54.1722034,57.8534746 C54.0857627,55.8924576 52.4967797,54.3034746 50.5357627,54.3034746 L50.1815254,54.3034746 C48.2205085,54.3034746 46.630678,55.8933051 46.630678,57.8534746 L46.630678,60.7382203 C46.630678,62.6975424 48.2205085,64.2873729 50.1815254,64.2873729 Z" id="Stroke-1" stroke="#FEFEFE"></path>
		                        <path d="M37.1805085,71.0424576 C37.0677966,70.7916102 36.9533898,70.7000847 36.7966102,70.5899153 C35.6415254,69.785678 32.3915254,67.9399153 28.5754237,67.9170339 L28.5754237,67.915339 C28.5635593,67.915339 28.5525424,67.9170339 28.540678,67.9170339 C28.529661,67.9170339 28.5186441,67.915339 28.5076271,67.915339 L28.5076271,67.9170339 C24.690678,67.9399153 21.440678,69.785678 20.2855932,70.5899153 C20.1288136,70.7000847 20.0161017,70.7916102 19.9016949,71.0424576 C19.809322,71.2483898 19.7228814,71.6661864 19.7228814,71.6661864 L19.7228814,75.1229661 L37.3601695,75.1229661 L37.3601695,71.6661864 C37.3601695,71.6661864 37.2737288,71.2483898 37.1805085,71.0424576 Z M28.329661,64.2873729 L28.6838983,64.2873729 C30.6449153,64.2873729 32.2338983,62.6975424 32.3211864,60.7382203 L32.3211864,57.8534746 C32.2347458,55.8924576 30.6449153,54.3034746 28.6838983,54.3034746 L28.329661,54.3034746 C26.3686441,54.3034746 24.779661,55.8933051 24.779661,57.8534746 L24.779661,60.7382203 C24.779661,62.6975424 26.3686441,64.2873729 28.329661,64.2873729 Z" id="Stroke-3" stroke="#FEFEFE"></path>
		                        <path d="M80.8833898,71.0433051 C80.770678,70.7916102 80.6562712,70.7000847 80.4994915,70.5899153 C79.3452542,69.785678 76.0952542,67.9399153 72.2783051,67.9178814 L72.2783051,67.915339 C72.2664407,67.915339 72.2554237,67.9170339 72.2444068,67.9170339 C72.2325424,67.9170339 72.2215254,67.915339 72.2105085,67.915339 L72.2105085,67.9178814 C68.3944068,67.9399153 65.1444068,69.785678 63.9884746,70.5899153 C63.8316949,70.7000847 63.7181356,70.7916102 63.6045763,71.0424576 C63.5122034,71.2483898 63.4257627,71.6661864 63.4257627,71.6661864 L63.4257627,75.1229661 L81.0630508,75.1238136 L81.0630508,71.6661864 C81.0630508,71.6661864 80.9766102,71.2483898 80.8833898,71.0433051 Z M72.0333898,64.2873729 L72.3876271,64.2873729 C74.3477966,64.2873729 75.9367797,62.6975424 76.0240678,60.7382203 L76.0240678,57.8534746 C75.9376271,55.8924576 74.3477966,54.3034746 72.3876271,54.3034746 L72.0333898,54.3034746 C70.0715254,54.3034746 68.4825424,55.8933051 68.4825424,57.8534746 L68.4825424,60.7382203 C68.4825424,62.6975424 70.0715254,64.2873729 72.0333898,64.2873729 Z" id="Stroke-5" stroke="#FEFEFE"></path>
		                        <path d="M100,50 C100,77.6144068 77.6144068,100 50,100 C22.3855932,100 0,77.6144068 0,50 C0,22.3855932 22.3855932,0 50,0 C77.6144068,0 100,22.3855932 100,50 Z" id="Stroke-7" stroke="#FEFEFE"></path>
		                        <g id="Group-27" opacity="0.15" transform="translate(20.338983, 21.186441)" stroke="#FEFEFE">
		                            <path d="M15.0034746,6.61661017 L15.0034746,26.4284746" id="Stroke-9"></path>
		                            <path d="M0,6.48254237 L0,26.4283051" id="Stroke-11"></path>
		                            <path d="M7.50177966,0.0972033898 L7.50177966,26.4285593" id="Stroke-13"></path>
		                            <path d="M60.0130508,6.61661017 L60.0130508,26.4284746" id="Stroke-15"></path>
		                            <path d="M30.0065254,6.19457627 L30.0065254,26.4284746" id="Stroke-17"></path>
		                            <path d="M37.5083051,0.724576271 L37.5083051,26.4288136" id="Stroke-19"></path>
		                            <path d="M45.0095763,6.48254237 L45.0095763,26.4283051" id="Stroke-21"></path>
		                            <path d="M52.5117797,0.0972033898 L52.5117797,26.4285593" id="Stroke-23"></path>
		                            <path d="M22.5048305,0.0972033898 L22.5048305,26.4285593" id="Stroke-25"></path>
		                        </g>
		                        <polyline id="Stroke-28" stroke="#0070D6" points="24.1525424 42.7966102 36.0169492 34.3220339 42.7966102 42.7966102 58.0508475 27.5423729 65.6779661 36.0169492 78.3898305 25.8474576"></polyline>
		                    </g>
		                    <text id="vehicle-analytics-graphic-text" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="32" fill="#FFFFFF">
		                        <tspan x="236.098633" y="126">Vehicle analytics</tspan>
		                    </text>
		                    <g id="vehicle-analytics-graphic" transform="translate(265.000000, 0.000000)" stroke-linejoin="round" stroke-width="2">
		                        <path d="M100,50 C100,77.6144068 77.6144068,100 50,100 C22.3855932,100 0,77.6144068 0,50 C0,22.3855932 22.3855932,0 50,0 C77.6144068,0 100,22.3855932 100,50 Z" id="Stroke-1" stroke="#FEFEFE" stroke-linecap="round"></path>
		                        <g id="Group-21" opacity="0.15" transform="translate(20.338983, 21.186441)" stroke="#FEFEFE" stroke-linecap="round">
		                            <path d="M15.0034746,6.61661017 L15.0034746,26.4284746" id="Stroke-3"></path>
		                            <path d="M0,6.48254237 L0,26.4283051" id="Stroke-5"></path>
		                            <path d="M7.50177966,0.0976271186 L7.50177966,26.4281356" id="Stroke-7"></path>
		                            <path d="M60.0130508,6.61661017 L60.0130508,26.4284746" id="Stroke-9"></path>
		                            <path d="M30.0065254,6.19457627 L30.0065254,26.4284746" id="Stroke-11"></path>
		                            <path d="M37.5083051,0.724152542 L37.5083051,26.4283898" id="Stroke-13"></path>
		                            <path d="M45.0095763,6.48254237 L45.0095763,26.4283051" id="Stroke-15"></path>
		                            <path d="M52.5117797,0.0976271186 L52.5117797,26.4281356" id="Stroke-17"></path>
		                            <path d="M22.5048305,0.0976271186 L22.5048305,26.4281356" id="Stroke-19"></path>
		                        </g>
		                        <path d="M35.765339,68.695339 L39.0475424,58.2605932 C39.1314407,57.9241525 39.4678814,57.6716102 39.8890678,57.6716102 L59.6899153,57.6716102 C60.1111017,57.6716102 60.4475424,57.9241525 60.5314407,58.345339 L63.8136441,68.695339" id="Stroke-22" stroke="#FEFEFE"></path>
		                        <path d="M65.74,79.9117797 L34.1679661,79.9117797 L34.1755932,69.5948305 C34.1755932,69.1194068 34.4933898,68.8016102 34.969661,68.8016102 L35.7628814,68.8016102 L64.1688136,68.8016102 L64.9620339,68.8016102 C65.4391525,68.8016102 65.7561017,69.1194068 65.7561017,69.5948305 L65.7561017,79.164322 L65.74,80.0236441" id="Stroke-24" stroke="#FEFEFE"></path>
		                        <path d="M41.2159322,74.6292373 C41.2159322,75.6512712 40.3871186,76.4800847 39.3659322,76.4800847 C38.3438983,76.4800847 37.5150847,75.6512712 37.5150847,74.6292373 C37.5150847,73.6080508 38.3438983,72.7792373 39.3659322,72.7792373 C40.3871186,72.7792373 41.2159322,73.6080508 41.2159322,74.6292373 Z" id="Stroke-26" stroke="#FEFEFE"></path>
		                        <path d="M62.8020339,74.6292373 C62.8020339,75.6512712 61.9732203,76.4800847 60.9511864,76.4800847 C59.9291525,76.4800847 59.1011864,75.6512712 59.1011864,74.6292373 C59.1011864,73.6080508 59.9291525,72.7792373 60.9511864,72.7792373 C61.9732203,72.7792373 62.8020339,73.6080508 62.8020339,74.6292373 Z" id="Stroke-28" stroke="#FEFEFE"></path>
		                        <path d="M37.3564407,80.0119492 L37.3564407,83.485678 C37.3564407,84.3619492 36.6394915,85.0788983 35.7623729,85.0788983 C34.8852542,85.0788983 34.1683051,84.3619492 34.1683051,83.485678 L34.1683051,79.835678" id="Stroke-30" stroke="#FEFEFE"></path>
		                        <path d="M65.7640678,79.835678 L65.7640678,83.485678 C65.7640678,84.3619492 65.0462712,85.0788983 64.1691525,85.0788983 C63.2928814,85.0788983 62.5750847,84.3619492 62.5750847,83.485678 L62.5750847,80.0119492" id="Stroke-32" stroke="#FEFEFE"></path>
		                        <polyline id="Stroke-34" stroke="#0070D6" stroke-linecap="round" points="24.1525424 42.7966102 36.0169492 34.3220339 42.7966102 42.7966102 58.0508475 27.5423729 65.6779661 36.0169492 78.3898305 25.8474576"></polyline>
		                    </g>
		                </g>


		            </g>
		        </g>
		    </g>
		</svg>

	<!-- </div> -->
</div>


<!-- Marketplace Risk Analytics Graphic DESKTOP -->
<div class="container" id="custom-feature__marketplace-risk-graphic">

	<div class="row">
		<svg id="mr-analytics-head-graphic" width="468px" height="161px" viewBox="0 0 468 161" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		    <!-- Generator: Sketch 53.2 (72643) - https://sketchapp.com -->
		    <title>Marketplace Risk Analytics Head Graphic</title>
		    <g id="Pages_1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <g id="Key_Graphic_Desktop_Head" transform="translate(-370.000000, -259.000000)">
		            <g id="mr-analytics-head" transform="translate(357.000000, 260.000000)">
		                <g id="vehicle-analytics" transform="translate(320.000000, 0.000000)">
		                    <text id="vehicle-analytic-title" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="26" fill="#FFFFFF">
		                        <tspan x="4.59863281" y="153">Vehicle analytics</tspan>
		                    </text>
		                    <g id="vehicle-analytics-graphic" transform="translate(23.000000, 0.000000)" stroke-linejoin="round" stroke-width="2">
		                        <path d="M120,60 C120,93.1372881 93.1372881,120 60,120 C26.8627119,120 0,93.1372881 0,60 C0,26.8627119 26.8627119,0 60,0 C93.1372881,0 120,26.8627119 120,60 Z" id="Stroke-1" stroke="#FEFEFE" stroke-linecap="round"></path>
		                        <g id="Group-21" opacity="0.15" transform="translate(24.406780, 25.423729)" stroke="#FEFEFE" stroke-linecap="round">
		                            <path d="M18.0041695,7.9399322 L18.0041695,31.7141695" id="Stroke-3"></path>
		                            <path d="M0,7.77905085 L0,31.7139661" id="Stroke-5"></path>
		                            <path d="M9.00213559,0.117152542 L9.00213559,31.7137627" id="Stroke-7"></path>
		                            <path d="M72.015661,7.9399322 L72.015661,31.7141695" id="Stroke-9"></path>
		                            <path d="M36.0078305,7.43349153 L36.0078305,31.7141695" id="Stroke-11"></path>
		                            <path d="M45.0099661,0.868983051 L45.0099661,31.7140678" id="Stroke-13"></path>
		                            <path d="M54.0114915,7.77905085 L54.0114915,31.7139661" id="Stroke-15"></path>
		                            <path d="M63.0141356,0.117152542 L63.0141356,31.7137627" id="Stroke-17"></path>
		                            <path d="M27.0057966,0.117152542 L27.0057966,31.7137627" id="Stroke-19"></path>
		                        </g>
		                        <path d="M42.9184068,82.4344068 L46.8570508,69.9127119 C46.9577288,69.5089831 47.3614576,69.2059322 47.8668814,69.2059322 L71.6278983,69.2059322 C72.133322,69.2059322 72.5370508,69.5089831 72.6377288,70.0144068 L76.5763729,82.4344068" id="Stroke-22" stroke="#FEFEFE"></path>
		                        <path d="M78.888,95.8941356 L41.0015593,95.8941356 L41.0107119,83.5137966 C41.0107119,82.9432881 41.3920678,82.5619322 41.9635932,82.5619322 L42.9154576,82.5619322 L77.0025763,82.5619322 L77.9544407,82.5619322 C78.5269831,82.5619322 78.907322,82.9432881 78.907322,83.5137966 L78.907322,94.9971864 L78.888,96.0283729" id="Stroke-24" stroke="#FEFEFE"></path>
		                        <path d="M49.4591186,89.5550847 C49.4591186,90.7815254 48.4645424,91.7761017 47.2391186,91.7761017 C46.012678,91.7761017 45.0181017,90.7815254 45.0181017,89.5550847 C45.0181017,88.329661 46.012678,87.3350847 47.2391186,87.3350847 C48.4645424,87.3350847 49.4591186,88.329661 49.4591186,89.5550847 Z" id="Stroke-26" stroke="#FEFEFE"></path>
		                        <path d="M75.3624407,89.5550847 C75.3624407,90.7815254 74.3678644,91.7761017 73.1414237,91.7761017 C71.9149831,91.7761017 70.9214237,90.7815254 70.9214237,89.5550847 C70.9214237,88.329661 71.9149831,87.3350847 73.1414237,87.3350847 C74.3678644,87.3350847 75.3624407,88.329661 75.3624407,89.5550847 Z" id="Stroke-28" stroke="#FEFEFE"></path>
		                        <path d="M44.8277288,96.014339 L44.8277288,100.182814 C44.8277288,101.234339 43.9673898,102.094678 42.9148475,102.094678 C41.8623051,102.094678 41.0019661,101.234339 41.0019661,100.182814 L41.0019661,95.8028136" id="Stroke-30" stroke="#FEFEFE"></path>
		                        <path d="M78.9168814,95.8028136 L78.9168814,100.182814 C78.9168814,101.234339 78.0555254,102.094678 77.0029831,102.094678 C75.9514576,102.094678 75.0901017,101.234339 75.0901017,100.182814 L75.0901017,96.014339" id="Stroke-32" stroke="#FEFEFE"></path>
		                        <polyline id="Stroke-34" stroke="#0070D6" stroke-linecap="round" points="28.9830508 51.3559322 43.220339 41.1864407 51.3559322 51.3559322 69.6610169 33.0508475 78.8135593 43.220339 94.0677966 31.0169492"></polyline>
		                    </g>
		                </g>
		                <g id="plus" transform="translate(221.000000, 43.000000)" fill-rule="nonzero" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		                    <g id="Group">
		                        <path d="M21.5,0 L21.5,43" id="Path-4"></path>
		                        <path d="M43,22.4347826 L0,22.4347826" id="Path-4"></path>
		                    </g>
		                </g>
		                <g id="driver-analytics">
		                    <text id="driver-analytics-title" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="26" fill="#FFFFFF">
		                        <tspan x="11.5917969" y="154">Driver analytics</tspan>
		                    </text>
		                    <g id="driver-analytics-graphic" transform="translate(23.000000, 0.000000)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		                        <path d="M70.8388475,85.2509492 C70.7025763,84.9499322 70.5652881,84.8401017 70.3781695,84.7078983 C68.9920678,83.7428136 65.0920678,81.5278983 60.5117288,81.5014576 L60.5117288,81.4984068 C60.4985085,81.4984068 60.4842712,81.5004407 60.4710508,81.5004407 C60.4578305,81.5004407 60.4446102,81.4984068 60.4303729,81.4984068 L60.4303729,81.5014576 C55.8510508,81.5278983 51.9510508,83.7428136 50.5649492,84.7078983 C50.3757966,84.8401017 50.2405424,84.9499322 50.1032542,85.2509492 C49.9924068,85.4980678 49.888678,85.9994237 49.888678,85.9994237 L49.888678,90.1475593 L71.0544407,90.1475593 L71.0544407,85.9994237 C71.0544407,85.9994237 70.9496949,85.4980678 70.8388475,85.2509492 Z M60.2178305,77.1448475 L60.6429153,77.1448475 C62.9961356,77.1448475 64.9029153,75.2370508 65.0066441,72.8858644 L65.0066441,69.4241695 C64.9029153,67.0709492 62.9961356,65.1641695 60.6429153,65.1641695 L60.2178305,65.1641695 C57.8646102,65.1641695 55.9568136,67.0719661 55.9568136,69.4241695 L55.9568136,72.8858644 C55.9568136,75.2370508 57.8646102,77.1448475 60.2178305,77.1448475 Z" id="Stroke-1" stroke="#FEFEFE"></path>
		                        <path d="M44.6166102,85.2509492 C44.4813559,84.9499322 44.3440678,84.8401017 44.1559322,84.7078983 C42.7698305,83.7428136 38.8698305,81.5278983 34.2905085,81.5004407 L34.2905085,81.4984068 C34.2762712,81.4984068 34.2630508,81.5004407 34.2488136,81.5004407 C34.2355932,81.5004407 34.2223729,81.4984068 34.2091525,81.4984068 L34.2091525,81.5004407 C29.6288136,81.5278983 25.7288136,83.7428136 24.3427119,84.7078983 C24.1545763,84.8401017 24.019322,84.9499322 23.8820339,85.2509492 C23.7711864,85.4980678 23.6674576,85.9994237 23.6674576,85.9994237 L23.6674576,90.1475593 L44.8322034,90.1475593 L44.8322034,85.9994237 C44.8322034,85.9994237 44.7284746,85.4980678 44.6166102,85.2509492 Z M33.9955932,77.1448475 L34.420678,77.1448475 C36.7738983,77.1448475 38.680678,75.2370508 38.7854237,72.8858644 L38.7854237,69.4241695 C38.6816949,67.0709492 36.7738983,65.1641695 34.420678,65.1641695 L33.9955932,65.1641695 C31.6423729,65.1641695 29.7355932,67.0719661 29.7355932,69.4241695 L29.7355932,72.8858644 C29.7355932,75.2370508 31.6423729,77.1448475 33.9955932,77.1448475 Z" id="Stroke-3" stroke="#FEFEFE"></path>
		                        <path d="M97.0600678,85.2519661 C96.9248136,84.9499322 96.7875254,84.8401017 96.5993898,84.7078983 C95.2143051,83.7428136 91.3143051,81.5278983 86.7339661,81.5014576 L86.7339661,81.4984068 C86.7197288,81.4984068 86.7065085,81.5004407 86.6932881,81.5004407 C86.6790508,81.5004407 86.6658305,81.4984068 86.6526102,81.4984068 L86.6526102,81.5014576 C82.0732881,81.5278983 78.1732881,83.7428136 76.7861695,84.7078983 C76.5980339,84.8401017 76.4617627,84.9499322 76.3254915,85.2509492 C76.2146441,85.4980678 76.1109153,85.9994237 76.1109153,85.9994237 L76.1109153,90.1475593 L97.275661,90.1485763 L97.275661,85.9994237 C97.275661,85.9994237 97.1719322,85.4980678 97.0600678,85.2519661 Z M86.4400678,77.1448475 L86.8651525,77.1448475 C89.2173559,77.1448475 91.1241356,75.2370508 91.2288814,72.8858644 L91.2288814,69.4241695 C91.1251525,67.0709492 89.2173559,65.1641695 86.8651525,65.1641695 L86.4400678,65.1641695 C84.0858305,65.1641695 82.1790508,67.0719661 82.1790508,69.4241695 L82.1790508,72.8858644 C82.1790508,75.2370508 84.0858305,77.1448475 86.4400678,77.1448475 Z" id="Stroke-5" stroke="#FEFEFE"></path>
		                        <path d="M120,60 C120,93.1372881 93.1372881,120 60,120 C26.8627119,120 0,93.1372881 0,60 C0,26.8627119 26.8627119,0 60,0 C93.1372881,0 120,26.8627119 120,60 Z" id="Stroke-7" stroke="#FEFEFE"></path>
		                        <g id="Group-27" opacity="0.15" transform="translate(24.406780, 25.423729)" stroke="#FEFEFE">
		                            <path d="M18.0041695,7.9399322 L18.0041695,31.7141695" id="Stroke-9"></path>
		                            <path d="M0,7.77905085 L0,31.7139661" id="Stroke-11"></path>
		                            <path d="M9.00213559,0.116644068 L9.00213559,31.7142712" id="Stroke-13"></path>
		                            <path d="M72.015661,7.9399322 L72.015661,31.7141695" id="Stroke-15"></path>
		                            <path d="M36.0078305,7.43349153 L36.0078305,31.7141695" id="Stroke-17"></path>
		                            <path d="M45.0099661,0.869491525 L45.0099661,31.7145763" id="Stroke-19"></path>
		                            <path d="M54.0114915,7.77905085 L54.0114915,31.7139661" id="Stroke-21"></path>
		                            <path d="M63.0141356,0.116644068 L63.0141356,31.7142712" id="Stroke-23"></path>
		                            <path d="M27.0057966,0.116644068 L27.0057966,31.7142712" id="Stroke-25"></path>
		                        </g>
		                        <polyline id="Stroke-28" stroke="#0070D6" points="28.9830508 51.3559322 43.220339 41.1864407 51.3559322 51.3559322 69.6610169 33.0508475 78.8135593 43.220339 94.0677966 31.0169492"></polyline>
		                    </g>
		                </g>
		            </g>
		        </g>
		    </g>
		</svg>
	</div>

	<div class="row">
		<svg id="mr-analytics-body-graphic" width="720px" height="744px" viewBox="0 0 720 744" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<defs>
				<style type="text/css">
					#animated-arrow-head-1, #animated-arrow-head-2, #animated-arrow-head-3, #animated-270deg-arc {
						opacity: 0;
					}
					#lozenge-1, .lozenge-1-blurb, #lozenge-2, .lozenge-2-blurb, #lozenge-3, .lozenge-3-blurb, #lozenge-4, .lozenge-4-blurb {
						opacity: 0;
						transition: opacity 0.8s ease-in-out;
					}
					#lozenge-1.visible, .lozenge-1-blurb.visible, #lozenge-2.visible, .lozenge-2-blurb.visible, #lozenge-3.visible, .lozenge-3-blurb.visible, #lozenge-4.visible, .lozenge-4-blurb.visible {
						opacity: 1;
					}
				</style>
				<clipPath id="lineClip1">
					<rect id="lineRect1" width="4" height="0" x="690" y="42">
				</clipPath>
				<clipPath id="lineClip2">
					<rect id="lineRect2" width="4" height="0" x="690" y="245">
				</clipPath>
				<clipPath id="lineClip3">
					<rect id="lineRect3" width="4" height="0" x="690" y="444">
				</clipPath>
			</defs>
		    <!-- Generator: Sketch 53.2 (72643) - https://sketchapp.com -->
		    <title>Marketplace Risk Analytics Body Graphic</title>
		    <g id="Pages_2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <g id="Key_Graphic_Desktop_Body" transform="translate(-265.000000, -453.000000)">
		            <g id="mr-analytics-body" transform="translate(265.000000, 453.000000)">
		                <text id="New-market-mobility" class="lozenge-4-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="430" y="709">New market </tspan>
		                    <tspan x="430" y="737">mobility insights</tspan>
		                </text>
		                <text id="Multimodal-demand-pr" class="lozenge-4-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="31" y="709">Multimodal demand </tspan>
		                    <tspan x="31" y="737">predictions</tspan>
		                </text>
		                <g id="lozenge-4" transform="translate(0.000000, 600.000000)">
		                    <path d="M30,0 L690,0 C706.568542,-3.04359188e-15 720,13.4314575 720,30 L720,30 C720,46.5685425 706.568542,60 690,60 L30,60 C13.4314575,60 2.02906125e-15,46.5685425 0,30 L0,30 C-2.02906125e-15,13.4314575 13.4314575,3.04359188e-15 30,0 Z" fill="#098189" fill-rule="nonzero"></path>
		                    <g id="arrow-oval-4" transform="translate(679.000000, 17.000000)" fill="#FFFFFF" fill-rule="nonzero">
		                        <circle id="oval-outer-4" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
		                        <circle id="oval-inner-4" cx="12.5" cy="12.5" r="5.5"></circle>
		                    </g>
		                    <text id="lozenge-4-title" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
		                        <tspan x="29" y="42">Diversify services</tspan>
		                    </text>
		                </g>
		                <text id="Shared-vehicle-suppl" class="lozenge-3-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="430" y="508">Shared vehicle supply </tspan>
		                    <tspan x="430" y="536">optimization</tspan>
		                </text>
		                <text id="Personalized-driver" class="lozenge-3-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="31" y="508">Personalized driver </tspan>
		                    <tspan x="31" y="536">and rider incentives</tspan>
		                </text>
		                <g id="lozenge-3" transform="translate(0.000000, 399.000000)">
		                    <path d="M30,0 L690,0 C706.568542,-3.04359188e-15 720,13.4314575 720,30 L720,30 C720,46.5685425 706.568542,60 690,60 L30,60 C13.4314575,60 2.02906125e-15,46.5685425 0,30 L0,30 C-2.02906125e-15,13.4314575 13.4314575,3.04359188e-15 30,0 Z" fill="#098189" fill-rule="nonzero"></path>
		                    <g id="arrow-oval-3" transform="translate(679.000000, 18.000000)" fill="#FFFFFF" fill-rule="nonzero">
		                        <circle id="oval-outer-3" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
		                        <circle id="oval-inner-3" cx="12.5" cy="12.5" r="5.5"></circle>
		                    </g>
		                    <text id="lozenge-3-title" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
		                        <tspan x="29" y="42">Increase adoption</tspan>
		                    </text>
		                </g>
		                <text id="Collision-analytics" class="lozenge-2-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="430" y="310">Collision analytics</tspan>
		                </text>
		                <text id="Driving-behavior-ana" class="lozenge-2-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="31" y="310">Driving behavior </tspan>
		                    <tspan x="31" y="338">analytics</tspan>
		                </text>
		                <g id="lozenge-2" transform="translate(0.000000, 201.000000)">
		                    <path d="M30,0 L690,0 C706.568542,-3.04359188e-15 720,13.4314575 720,30 L720,30 C720,46.5685425 706.568542,60 690,60 L30,60 C13.4314575,60 2.02906125e-15,46.5685425 0,30 L0,30 C-2.02906125e-15,13.4314575 13.4314575,3.04359188e-15 30,0 Z" id="lozenge-2-bg" fill="#098189" fill-rule="nonzero"></path>
		                    <g id="arrow-oval-2" transform="translate(679.000000, 17.000000)" fill="#FFFFFF" fill-rule="nonzero">
		                        <circle id="oval-outer-2" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
		                        <circle id="oval-inner-2" cx="12.5" cy="12.5" r="5.5"></circle>
		                    </g>
		                    <text id="lozenge-2-title" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
		                        <tspan x="29" y="42">Reduce loss costs</tspan>
		                    </text>
		                </g>
		                <text id="Predictive-maintenan" class="lozenge-1-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="430" y="108">Predictive </tspan>
		                    <tspan x="430" y="136">maintenance</tspan>
		                </text>
		                <text id="Predict-risk-of-new" class="lozenge-1-blurb" font-family="Roboto-Regular, Roboto" font-size="21" font-weight="normal" line-spacing="28" fill="#FFFFFF">
		                    <tspan x="31" y="109">Predict risk of new or </tspan>
		                    <tspan x="31" y="137">like-new members</tspan>
		                </text>
		                <g id="lozenge-1">
		                    <path d="M30,0 L690,0 C706.568542,-3.04359188e-15 720,13.4314575 720,30 L720,30 C720,46.5685425 706.568542,60 690,60 L30,60 C13.4314575,60 2.02906125e-15,46.5685425 0,30 L0,30 C-2.02906125e-15,13.4314575 13.4314575,3.04359188e-15 30,0 Z" id="lozenge-1-bg" fill="#098189" fill-rule="nonzero"></path>
		                    <g id="arrow-oval-1" transform="translate(679.000000, 18.000000)" fill="#FFFFFF" fill-rule="nonzero">
		                        <circle id="oval-outer-1" opacity="0.466183036" cx="12.5" cy="12.5" r="12.5"></circle>
		                        <circle id="oval-inner-1" cx="12.5" cy="12.5" r="5.5"></circle>
		                    </g>
		                    <text id="lozenge-1-title" font-family="Roboto-Regular, Roboto" font-size="30" font-weight="normal" line-spacing="36" fill="#FFFFFF">
		                        <tspan x="29" y="42">Pre-driving risk mitigation</tspan>
		                    </text>
		                </g>
		                <g id="arrow-head-3" transform="translate(668.000000, 611.000000)" fill-rule="nonzero" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		                    <polyline id="animated-arrow-head-3" transform="translate(4.000000, 19.000000) rotate(-180.000000) translate(-4.000000, -19.000000) " points="0 17 4 21 8 17"></polyline>
		                    <path id="animated-270deg-arc" d="M4,19 C4,29.4934102 12.5065898,38 23,38 L23,38 C33.4934102,38 42,29.4934102 42,19 C42,8.50658975 33.4934102,0 23,0" id="arrow-line-solid-135deg"></path>
		                </g>
	                	<g id="lineReveal3" clip-path="url(#lineClip3)">
	                		<path d="M691.25,445 L691.25,610" id="animated-arrow-line-3" stroke="#FFFFFF" stroke-width="2" fill="#D8D8D8" fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,4"></path>
	                	</g>
		                <polyline id="animated-arrow-head-2" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill-rule="nonzero" points="687 409 691.5 414 696 409"></polyline>
		                <g id="LineReveal2" clip-path="url(#lineClip2)">
		                	<path d="M691.25,246 L691.25,411" id="animated-arrow-line-2" stroke="#FFFFFF" stroke-width="2" fill="#D8D8D8" fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,4"></path>
		                </g>
		                <polyline id="animated-arrow-head-1" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill-rule="nonzero" points="687 210 691.5 215 696 210"></polyline>
		                <g id="lineReveal1" clip-path="url(#lineClip1)">
		                	<path d="M691.25,43 L691.25,214" id="animated-arrow-line-1" stroke="#FFFFFF" stroke-width="2" fill="#D8D8D8" fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1,4"></path>
		              	</g>
		            </g>
		        </g>
		    </g>
		</svg>
	</div>

</div>
<!--  -->
<script>
	function revealElement(elementIdentifier) {
		var els = document.querySelectorAll(elementIdentifier);
		els.forEach(function(el) {
			el.classList.add("visible");
		});		
	}

	function drawDottedLine(lineNum, lineHeight) {
		var clipPathID = "#lineRect" + lineNum;
		var arrowID = "#animated-arrow-head-" + lineNum;
		var theDelay = 0.6;
		TweenMax.to(clipPathID, 0.75, {attr:{height: lineHeight}, ease: Power2.easeInOut});
		if (clipPathID != "#lineRect3") {
			TweenMax.to(arrowID, 0.4, {css: {opacity: 1}, delay: theDelay});
		}
	}

	function drawMobileDottedLine(lineNum, lineHeight) {
		var clipPathID = "#lineRect" + lineNum + "_mobile";
		var arrowID = "#arrow-head-" + lineNum + "_mobile";
		var theDelay = 0.6;
		TweenMax.to(clipPathID, 0.75, {attr:{height: lineHeight}, ease: Power2.easeInOut});
		if (clipPathID != "#lineRect3_mobile") {
			TweenMax.to(arrowID, 0.4, {css: {opacity: 1}, delay: theDelay});
		}
	}

	function drawPath(pathID, drawSpeed) {
		var thePath = document.getElementById(pathID);
		var pathLength = Math.ceil(thePath.getTotalLength());
		console.log("pathLength: " + pathLength);
		thePath.style.transition = thePath.style.WebkitTransition = 'none';
		thePath.style.strokeDasharray = pathLength + ', ' + pathLength;
		thePath.style.strokeDashoffset = pathLength;
		thePath.getBoundingClientRect();
		thePath.style.transition = thePath.style.WebkitTransition = 'stroke-dashoffset ' + drawSpeed + 's ease-in-out';
		thePath.style.strokeDashoffset = pathLength * 2;
		thePath.style.opacity = 1;
	}

	window.onload = function() {
		var controller = new ScrollMagic.Controller();

		// Mobile animation sequences
		var seq0_mob = new ScrollMagic.Scene({
			triggerElement: "#custom-feature__marketplace-risk-graphic_mobile",
			triggerHook: 0.9,
			offset: 50,
			reverse: false
		})
		.setClassToggle("#mr-analytics-head-graphic_mobile", "visible")
		.addTo(controller);

		var seq1_mob = new ScrollMagic.Scene({
			triggerElement: "#rectangle-1-group_mobile",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.setClassToggle("#rectangle-1-group_mobile", "visible")
		.addTo(controller);

		var seq1a_mob = new ScrollMagic.Scene({
			triggerElement: ".rectangle-1-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.on("start", function (e) {
			drawMobileDottedLine(1, 159);
		})
		.setClassToggle(".rectangle-1-blurb", "visible")
		.addTo(controller);

		var seq2_mob = new ScrollMagic.Scene({
			triggerElement: "#rectangle-2-group_mobile",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.setClassToggle("#rectangle-2-group_mobile", "visible")
		.addTo(controller);

		var seq2a_mob = new ScrollMagic.Scene({
			triggerElement: ".rectangle-2-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.on("start", function (e) {
			drawMobileDottedLine(2, 155);
		})
		.setClassToggle(".rectangle-2-blurb", "visible")
		.addTo(controller);

		var seq3_mob = new ScrollMagic.Scene({
			triggerElement: "#rectangle-3-group_mobile",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.setClassToggle("#rectangle-3-group_mobile", "visible")
		.addTo(controller);

		var seq3a_mob = new ScrollMagic.Scene({
			triggerElement: ".rectangle-3-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.on("start", function (e) {
			drawMobileDottedLine(3, 164);
		})
		.setClassToggle(".rectangle-3-blurb", "visible")
		.addTo(controller);

		var seq4_mob = new ScrollMagic.Scene({
			triggerElement: "#rectangle-4-group_mobile",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.on("start", function (e) {
			var initDelay = 0.3;
			TweenMax.delayedCall(initDelay, drawPath, ["animated-270deg-arc_mobile", 0.75]);
			// drawPath("animated-270deg-arc_mobile", 0.75);
			TweenMax.to("#arrow-head-3_mobile", 0.4, {css: {opacity: 1}, delay: (initDelay + 0.75)});
		})
		.setClassToggle("#rectangle-4-group_mobile", "visible")
		.addTo(controller);

		var seq4a_mob = new ScrollMagic.Scene({
			triggerElement: ".rectangle-4-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.setClassToggle(".rectangle-4-blurb", "visible")
		.addTo(controller);


		// Desktop animation sequences
		var seq0 = new ScrollMagic.Scene({
			triggerElement: "#custom-feature__marketplace-risk-graphic",
			triggerHook: 0.9,
			offset: 50,
			reverse: false
		})
		.setClassToggle("#mr-analytics-head-graphic", "visible")
		.addTo(controller);

		var seq1 = new ScrollMagic.Scene({
			triggerElement: "#lozenge-1",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.setClassToggle("#lozenge-1", "visible")
		.addTo(controller);

		var seq1a = new ScrollMagic.Scene({
			triggerElement: ".lozenge-1-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.on("start", function (e) {
			drawDottedLine(1, 172);
		})
		.setClassToggle(".lozenge-1-blurb", "visible")
		.addTo(controller);

		var seq2 = new ScrollMagic.Scene({
			triggerElement: "#lozenge-2",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.setClassToggle("#lozenge-2", "visible")
		.addTo(controller);

		var seq2a = new ScrollMagic.Scene({
			triggerElement: ".lozenge-2-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.on("start", function (e) {
			drawDottedLine(2, 166);
		})
		.setClassToggle(".lozenge-2-blurb", "visible")
		.addTo(controller);

		var seq3 = new ScrollMagic.Scene({
			triggerElement: "#lozenge-3",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.setClassToggle("#lozenge-3", "visible")
		.addTo(controller);

		var seq3a = new ScrollMagic.Scene({
			triggerElement: ".lozenge-3-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.on("start", function (e) {
			drawDottedLine(3, 166);
		})
		.setClassToggle(".lozenge-3-blurb", "visible")
		.addTo(controller);

		var seq4 = new ScrollMagic.Scene({
			triggerElement: "#lozenge-4",
			triggerHook: 0.9,
			offset: 20,
			reverse: false
		})
		.on("start", function (e) {
			drawPath("animated-270deg-arc", 0.75);
			TweenMax.to("#animated-arrow-head-3", 0.4, {css: {opacity: 1}, delay: 0.75});
		})
		.setClassToggle("#lozenge-4", "visible")
		.addTo(controller);

		var seq4a = new ScrollMagic.Scene({
			triggerElement: ".lozenge-4-blurb",
			triggerHook: 0.9,
			offset: 0,
			reverse: false
		})
		.setClassToggle(".lozenge-4-blurb", "visible")
		.addTo(controller);
	}

</script>
