<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PST Menjawab | Chatbot</title>
		<link rel="icon" href="/assets/images/logo-pst.png">
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://unpkg.com/react@18/umd/react.development.js"></script>
		<script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
		<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
		<script src="https://unpkg.com/lucide@latest"></script>
		<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
	</head>

	<body class="bg-oranye-1 flex flex-col items-center justify-center min-h-screen p-4 mt-28 md:mt-16">
		
		<?php include 'header_user.php';?>

		<main>
			<div id="root" class="w-full max-w-4xl">
				<!-- Load your React component -->
				<script type="text/babel" src="/js/Chatbot.js"></script>
				<script type="text/babel">
					const root = ReactDOM.createRoot(document.getElementById('root'));
					root.render(<Chatbot />);
				</script>
			</div>
		</main>

		<?php include 'footer.php';?>
	</body>
</html>