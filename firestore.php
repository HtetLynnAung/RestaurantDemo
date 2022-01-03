<?php 

	require_once 'vendor/autoload.php';
	use Google\Cloud\Firestore\FirestoreClient;

	class Firestore{


		protected $db;
		protected $name;
		public function __construct(string $collection)
		{
			$this->db = new FirestoreClient([
				'projectId' => 'restaurantdemo-bc376'
			]);


			$this->name = $collection;

		}


		public function getDocument(string $name){
			return $this->db->collection($this->name)->document($name)->snapshot()->data();
		}


		public function setNewDocument(string $name, array $data = []){

			try{

				$this->db->collection($this->name)->document($name)->create($data);
				return true;

			}catch(Exception $exception){

				return	0;

			}

			// $db->collection('menu')->document('Sandwish')->set($data);
			// printf('Added document with ID: Sandwish'.PHP_EOL);

		}






	public function data_get_all_documents(){

	    # [START fs_get_all_docs]
	    # [START firestore_data_get_all_documents]
	    $citiesRef = $this->db->collection('menu');
	    $documents = $citiesRef->documents();
	    return $documents;


	    # [END firestore_data_get_all_documents]
	    # [END fs_get_all_docs]
		}
	}
 ?>
