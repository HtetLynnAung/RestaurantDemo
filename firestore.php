<?php 

	require_once 'vendor/autoload.php';
	use Google\Cloud\Firestore\FirestoreClient;
	use Google\Cloud\Storage\StorageClient;

	class Firestore
	{

		protected $db;
		protected $name;
		public function __construct(string $collection)
		{
			$this->db = new FirestoreClient([
				'projectId' => 'restaurantdemo-bc376'
			]);

			$this->name = $collection;

		}

		// GET DOCUMENT WITH MENU
		public function getDocument(string $name){
			return $this->db->collection($this->name)->document($name)->snapshot()->data();
		}


		// CREATE NEW DOCUMENT WITH MENU NAME
		public function setNewDocument(string $name, array $data = [])
		{
			try
			{
				$this->db->collection($this->name)->document($name)->create($data);
				return true;

			}
			catch(Exception $exception)
			{
				return	0;
			}

			// $db->collection('menu')->document('Sandwish')->set($data);
			// printf('Added document with ID: Sandwish'.PHP_EOL);

		}


		// GET ALL MENU FROM FIRESTORE DATABASE
		public function data_get_all_documents()
		{

		    # [START fs_get_all_docs]
		    # [START firestore_data_get_all_documents]
		    $citiesRef = $this->db->collection('menu');
		    $documents = $citiesRef->documents();
		    return $documents;

		    # [END firestore_data_get_all_documents]
		    # [END fs_get_all_docs]
		}

		// GET LATEST MENU FROM FIRESTORE DATABASE
		public function data_get_latest_documents()
		{

		    # [START fs_get_latest_docs]
		    # [START firestore_data_get_latest_documents]
		    $citiesRef = $this->db->collection('menu')->orderBy('date', 'desc')->limit(5);
		    $documents = $citiesRef->documents();
		    return $documents;

		    # [END firestore_data_get_latest_documents]
		    # [END fs_get_latest_docs]
		}

	}


	class cloudStorgae
	{

		function uploadObject($bucketName, $objectName, $source)
        {
            // $bucketName = 'my-bucket';
            // $objectName = 'my-object';
            // $source = '/path/to/your/file';
            $storage = new StorageClient([
            'keyFilePath' => getcwd(). '/restaurantdemo-bc376-b5f74658fe86.json']);
            $file = fopen($source, 'r');
            $bucket = $storage->bucket($bucketName);
            $object = $bucket->upload($file, [
                'name' => $objectName,
                'predefinedAcl' => 'publicRead'
            ]);
            //printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, );
            $returnURL = 'https://storage.googleapis.com/'.$bucketName.'/';
            //echo $returnURL;

            return $returnURL;
        }

    }

 ?>
