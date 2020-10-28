<!-- TODO : Display section topic for the question numbers on the right side. -->
<!-- TODO : When user presses submit, give an alert if he hasn't attempted all questions. -->
<!-- TODO : Add feature to select none of the options -->
<DOCTYPE! html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Question Page</title>

		<!-- Bootstrap CSS -->
		<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
		<!-- Custom CSS -->
		<link rel="stylesheet" href="questionPage.css">
		<!-- Favicon -->
    <link rel="icon" href="../../favicon.ico" />

		<!-- jQuery -->
		<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
		<!-- Popper.js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<!-- Bootstrap JS -->
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
		<!-- Bootbox JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

		<?php 

		session_start();
		if(!isset($_SESSION['regNum'])) : ?>

			<script>
				bootbox.alert("You have already completed the test OR you have not yet logged in.", () => {
					window.location.href="../login/";
				});
			</script>

		<?php endif;?>

		<!-- Set the status to loggedIn so that user can't go back. -->
		<script>localStorage.setItem('status', 'loggedIn');</script>

		<!-- Important to include the timer script only after the question-page script is loaded -->
		<script src="finishTest.js"></script>
		<script src="timer.js"></script>

	</head>

	<body>

		<div id="head">
			<div id="timer"></div>
		</div>

		<div id="question-body">
			<div id="current-question"></div>
			<div id="overview">
				<div class="questionOverview">1</div>
				<div class="questionOverview">2</div>
				<div class="questionOverview">3</div>
				<div class="questionOverview">4</div>
				<div class="questionOverview">5</div>
				<div class="questionOverview">6</div>
				<div class="questionOverview">7</div>
				<div class="questionOverview">8</div>
				<div class="questionOverview">9</div>
				<div class="questionOverview">10</div>
				<div class="questionOverview">11</div>
				<div class="questionOverview">12</div>
				<div class="questionOverview">13</div>
				<div class="questionOverview">14</div>
				<div class="questionOverview">15</div>
				<div class="questionOverview">16</div>
				<div class="questionOverview">17</div>
				<div class="questionOverview">18</div>
				<div class="questionOverview">19</div>
				<div class="questionOverview">20</div>
				<div class="questionOverview">21</div>
				<div class="questionOverview">22</div>
				<div class="questionOverview">23</div>
				<div class="questionOverview">24</div>
				<div class="questionOverview">25</div>
				<div class="questionOverview">26</div>
				<div class="questionOverview">27</div>
				<div class="questionOverview">28</div>
				<div class="questionOverview">29</div>
				<div class="questionOverview">30</div>
				<div class="questionOverview">31</div>
				<div class="questionOverview">32</div>
				<div class="questionOverview">33</div>
				<div class="questionOverview">34</div>
				<div class="questionOverview">35</div>
				<div class="questionOverview">36</div>
				<div class="questionOverview">37</div>
				<div class="questionOverview">38</div>
				<div class="questionOverview">39</div>
				<div class="questionOverview">40</div>
				<div class="questionOverview">41</div>
				<div class="questionOverview">42</div>
				<div class="questionOverview">43</div>
				<div class="questionOverview">44</div>
				<div class="questionOverview">45</div>
				<div class="questionOverview">46</div>
				<div class="questionOverview">47</div>
				<div class="questionOverview">48</div>
				<div class="questionOverview">49</div>
				<div class="questionOverview">50</div>
				<div class="questionOverview">51</div>
				<div class="questionOverview">52</div>
				<div class="questionOverview">53</div>
				<div class="questionOverview">54</div>
				<div class="questionOverview">55</div>
				<div class="questionOverview">56</div>
				<div class="questionOverview">57</div>
				<div class="questionOverview">58</div>
				<div class="questionOverview">59</div>
				<div class="questionOverview">60</div>
				<div class="questionOverview">61</div>
				<div class="questionOverview">62</div>
				<button type="button" id="submitTest">
					<span>Submit Answers!</span>
				</button>
			</div>
		</div>
		<!-- Custom JS -->
		<script src="questionPage.js"></script>
	</body>
</html>
