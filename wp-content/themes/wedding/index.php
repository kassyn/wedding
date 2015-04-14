<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>

	<div id="wrapper" class="active-for">
		<aside id="sidebar">
			<div class="form">
				<form action="">
					<ul>
						<li>
							<label for="">Nome como está no convite</label>
							<input type="text">
						</li>
						<li>
							<label for="">Quantidade de pessoas</label>
							<input type="text">
						</li>
						<li class="field-radio">
							<label for="">SIM <input type="radio"></label>
							<label for="">NÃO <input type="radio"></label>
						</li>
						<li><input type="submit" value="Confirmar Presença"></li>
					</ul>
				</form>
			</div>
			<nav class="navigation">
				<ul>
					<li class="grooms"><a href="" title="">Os noivos</a></li>
					<li class="maps"><a href="" title="">Cerimônia</a></li>
					<li class="presents active"><a href="" title="">Presentes</a></li>
					<li class="confirm"><a href="" title="">Confirmar</a></li>
				</ul>
			</nav>
		</aside>

		<div id="content">
			<div id="top">
				<div class="container">
					<div class="names">
						<div class="name">
							<strong>Accacio</strong>
							<p>Lorem ipsum dolor sit.</p>
							<p>Lorem ipsum dolor sit.</p>
						</div>
						<div class="and">&</div>
						<div class="name">
							<strong>Natália</strong>
							<p>Lorem ipsum dolor sit.</p>
							<p>Lorem ipsum dolor sit.</p>
						</div>					
					</div>

					<a href="" title="" class="btn-confirm">Confirmar Presença</a>
				</div>				
			</div>

			<section id="photos">
				<h2 class="title-section">Os Noivos</h2>
				<div class="container">
					<div class="collumn">
						<img src="http://placehold.it/470x485" alt="">
						<img src="http://placehold.it/470x225" alt="">						
					</div>
					<div class="collumn">
						<img src="http://placehold.it/470x200" alt="">
						<img src="http://placehold.it/470x165" alt="">
						<img src="http://placehold.it/220x315" alt="">
						<img src="http://placehold.it/220x315" alt="">						
					</div>
				</div>
			</section>

			<section id="ceremony">
				<h2 class="title-section">Cerimônia</h2>

				<div class="maps">
					<div class="container">
						<div class="box-info">
							<div class="info">
								<h2 class="title">title</h2>								
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet nam minus consequuntur voluptas dolore inventore nemo! Enim, aliquid, obcaecati. Suscipit.
							</div>
						</div>
					</div>
					<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d60403.05823789234!2d-41.934876750000015!3d-18.8785998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1scatedral+governador+valadares!5e0!3m2!1spt-BR!2sbr!4v1428922489870" height="450" frameborder="0"></iframe>
				</div>
			</section>

			<section id="gifts" class="container">
				<h2 class="title-section">Lista de Presentes</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, qui autem voluptate eos officia eum aliquid voluptas perferendis, sit consequuntur.</p>
				<div class="list-store">
					<a href="" class="store">
						<img src="http://placehold.it/100x20" alt="">
					</a>

					<a href="" class="store">
						<img src="http://placehold.it/100x20" alt="">
					</a>					
				</div>
			</section>

			<section id="confirm">
				<a class="btn-confirm-footer" href="" title="">
					confirmar <strong>presença</strong>
				</a>
			</section>
		</div>
	</div>
	
</body>
</html>