<!DOCTYPE html>
<?php 
require_once __DIR__ . '/../Services/ViewLogic/itemService.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="node_modules/alpinejs/dist/cdn.js" defer></script>
	<!-- tailwind -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <!-- bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	
	<link rel="stylesheet" href="src/cropper.css">
<script src="src/cropper.js"></script>
	<style>
        [x-cloak] {
			display: none;
		}

		.duration-300 {
			transition-duration: 300ms;
		}

		.ease-out {
			transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
		}

		.scale-90 {
			transform: scale(.9);
		}

		.scale-100 {
			transform: scale(1);
		}
    </style>
</head>

<body x-data="{ 'showModal': false, 'showModalDel' : false, selectedValue: '',selectedValue2: '', todos: []
}" @keydown.escape="showModal=false" x-cloak>
   <!-- your content goes here -->


<div x-init="init()">
<table class="border-collapse border border-teal-500 w-3/5 m-auto mt-4 mb-4 rounded">
        <thead>
            <tr class="border-collapse border-4 border-teal-500">
                <th class="border-collapse border-4 border-teal-500 p-3 font-bold uppercase bg-blue-200 text-gray-600 lg:table-cell">ID</th>
                <th class="border-collapse border-4 border-teal-500 p-3 font-bold uppercase bg-blue-200 text-gray-600 lg:table-cell">Gambar</th>
				<th class="border-collapse border-4 border-teal-500 p-3 font-bold uppercase bg-blue-200 text-gray-600 lg:table-cell">nama</th>
                <th class="border-collapse border-4 border-teal-500 p-3 font-bold uppercase bg-blue-200 text-gray-600 lg:table-cell">deskripsi</th>
				<th class="border-collapse border-4 border-teal-500 p-3 font-bold uppercase bg-blue-200 text-gray-600 lg:table-cell">jenis</th>
                <th class="border-collapse border-4 border-teal-500 p-3 font-bold uppercase bg-blue-200 text-gray-600 lg:table-cell">pilihan</th>
            </tr>
        </thead>

        <tbody>
			<?php 
			foreach ($dataPagination->data as $item) { 
			?>
				<tr>
					<td x-text="<?=$item->id?>" class="p-3 border-collapse border-2 border-teal-200 lg:table-cell"></td>
            		<td  x-text="'<?=$item->gambar?>'" class="p-3 border-collapse border-2 border-teal-200 lg:table-cell"></td>
					<td  x-text="'<?=$item->nama?>'" class="p-3 border-collapse border-2 border-teal-200 lg:table-cell"></td>
					<td  x-text="'<?=$item->deskripsi?>'" class="p-3 border-collapse border-2 border-teal-200 lg:table-cell"></td>
					<td  x-text="'<?=$item->jenis?>'" class="p-3 border-collapse border-2 border-teal-200 lg:table-cell"></td>
					<td class="p-3 border-collapse border-2 border-teal-200 lg:table-cell text-center"> 
                   		<button type="submit" class="m-2 mb-2 bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="showModalDel= true" x-on:click="selectedValue = <?=htmlspecialchars($item->id)?>, selectedValue2 = '<?=htmlspecialchars($item->gambar)?>'">Hapus</button>
                    	<button type="button" class="m-2 bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="showModal = true" x-on:click="selectedValue = <?=htmlspecialchars($item->id)?>">Ubah</button>
                	</td>
				</tr>

				<?php 
                } 
            ?>

		</tbody>
	

		

    </table>
				
				<?php //tombol pagination :
				
				SSPagination($dataPagination); ?> 


	</div>

    <section class="flex flex-wrap p-4 h-full items-center">
		<!--Overlay-->
		<div class="overflow-auto" style="background-color: rgba(0,0,0,0.5);backdrop-filter: blur(5px);" x-show="showModal" :class="{ 'fixed backdrop-blur-sm inset-0 z-10 flex items-center justify-center': showModal }">
			<!--Dialog-->
			<div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">Ubah Data</p>
					<div class="cursor-pointer z-50" @click="showModal = false">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
                        
					</div>
				</div>

<!-- tambah data -->

				<!-- content -->
				<form action="itemService" method="post" enctype="multipart/form-data">
				<div  class="text-center mt-4">
					<!--nama-->
					<ul>
						<li><label class="text-lg font-bold text-blue-500">nama barang : </label></li>
						<li><input type="text" name="nama" class="font-mono p-2 border-2 border-blue-500 rounded-lg bg-gray-100 text-base focus:outline-none focus:border-green-500 focus:ring-green-500 "></li>
					</ul>
					<!--gambar-->
					<ul>
						<li><label class="text-lg font-bold text-blue-500">upload : </label> </li>
						<li><Input class="text-lg font-bold text-blue-500" accept="image/jpeg, image/jpg, image/png" type="file" name="gambar"></li>


					</ul>
					<!--deskripsi-->
					<ul>
						<li><label class="text-lg font-bold text-blue-500">deskripsi : </label></li>
						<li><input type="text" name="deskripsi" class="font-mono p-2 border-2 border-blue-500 rounded-lg bg-gray-100 text-base focus:outline-none focus:border-green-500 focus:ring-green-500 "></li>
					</ul>
					<!--jenis-->
					<ul>
						<li><label class="text-lg font-bold text-blue-500">jenis: </label></li>
						<li><input type="text" name="jenis" class="font-mono p-2 border-2 border-blue-500 rounded-lg bg-gray-100 text-base focus:outline-none focus:border-green-500 focus:ring-green-500 "></li>
					</ul>	
						<input type="hidden" name="id" x-bind:value="selectedValue">
					<br><br>
				</div>
				

				<!--Footer-->
				<div class="flex justify-end pt-2">
					<button type="button" class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" @click="alert(selectedValue);">Action</button>
					<button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" name="ubahItem">Ubah</button>
				</div>
			</form>


			</div>
			<!--/Dialog -->
		</div><!-- /Overlay -->

	</section>


  <script>

  </script>




    <section class="flex flex-wrap p-4 h-full items-center">
		<!--Overlay-->
		<div class="overflow-auto" style="background-color: rgba(0,0,0,0.5);backdrop-filter: blur(5px);" x-show="showModalDel" :class="{ 'fixed inset-0 z-10 flex items-center justify-center': showModalDel }">
			<!--Dialog-->
			<div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModalDel" @click.away="showModalDel = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">Hapus Data</p>
					<div class="cursor-pointer z-50" @click="showModalDel = false">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
                        
					</div>
				</div>

				<!-- content -->
				<ul class="my-5 bg-blue-200 border-2 border-teal-500 rounded-lg p-5">
					<li><p class="font-mono">Apakah anda ingin menghapus data data dengan id = <span x-text="selectedValue"></span>, dengan gambar = <span x-text="selectedValue2"></span></p></li>
				</ul>
				

				<!--Footer-->
				<div class="flex justify-end pt-2">
                     <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" @click="alert('id : ' + selectedValue);">Cek id item</button>
                     <form action="itemService" method="post">
						<input type="hidden" name="gambar" x-bind:value="selectedValue2" >
						<button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" name="deleteItem" x-bind:value="selectedValue">Hapus</button>
					</form>
					
					
				</div>


			</div>
			<!--/Dialog -->
		</div><!-- /Overlay -->

	</section>

<div x-data="{ selectedValue2: '' }">
  <button type="button" x-on:click="selectedValue2 = '232323'" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">ID</button>
  <button type="button" x-on:click="selectedValue2 = 'asdasdasd'" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Name</button>

  <input type="input" x-bind:value="selectedValue2" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">
</div>
</body>
</html>