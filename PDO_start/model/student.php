<?php
use OpenApi\Annotations as OA;

    /**
     * @OA\Info(title="My First API", version="0.1")
     *   @OA\Contact(
     *    email="support@example.com"
     *   )
     */


     /**
      *@OA\SecurityScheme(bearerFormat="JWT", type="apiKey", securityScheme="bearer") 
      *
      */

    /**
     * @OA\Schema()
     */
  
    class Student{
        private $table = 'students';
        public $conn;
    
    /**
    * @OA\Property(type="integer")
    *
    * @var int
    */
       public $id;
       
    /**
     * @OA\Property(type="string")
     *
     * @var string
     */  
        public $name;
        
        public function __construct($db){
            $this->conn = $db;
        }
    /**
    * @OA\Get(
        * path="/api/student/read.php",
        * security={"bearer"},
        * tags={"student"},
        * summary="xuất ra thông tin tất cả sinh viên",
        * operationId="read",
        * description="Get all info",
        * @OA\Parameter(
        *         name="page",
        *         in="query",
        *         description="page number",
        *         required=true,
        *         @OA\Schema(
        *           type="integer",
        *           format="int64"
        *         )
        *     ),
        * @OA\Response(
        *         response="200", 
        *         description="successful operation",
        *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/studentReadAllResponse"))
        *     ),
        *     @OA\Response(response=400, description="Invalid ID supplied"),
        *     @OA\Response(response=404, description="Pet not found")
        * )
    */
    
        public function read(){
            $query = 'select s.id, s.name from '. $this->table. ' s';
            $stm = $this->conn->prepare($query);
            $stm->execute();
            return $stm;
        }

        /**
        * @OA\GET(
            * path="/api/student/read_single.php",
            * tags={"student"},
            * security={"bearer"},
            * summary="Xuất ra thông tin một sinh viên dựa trên id",
            * description="Get one info",
            * operationId="read_single",
            *@OA\Parameter(
            *         name="id",
            *         in="query",
            *         description="ID of student",
            *         required=true,
            *         @OA\Schema(
            *           type="integer",
            *           format="int64"
            *         )
            *     ),
            * @OA\Response(
            *       response=200,
            *       description="successful operation",
            *       @OA\JsonContent(ref="#/components/schemas/studentReadSigleResponse")
            * ),
            * @OA\Response(response=400, description="Invalid ID supplied"),
            * @OA\Response(response=404, description="Pet not found")
            * )
        */
        public function read_single(){
            $query = 'select s.id, s.name from '. $this->table. ' s where id = ?';
            $stm = $this->conn->prepare($query);
            $stm->bindParam(1, $this->id);
            $stm->execute();
            return $stm;
        }
        
        public function create_single(){
            $query = 'insert into '. $this->table.' value(:id, :name)';
            $stm = $this->conn->prepare($query);
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $stm->bindParam(':id', $this->id);
            $stm->bindParam(':name', $this->name);
            if($stm->execute()){
            return true;
            } else{
                return false;
            }
        }
        
        public function update()
        {
            $query = 'update '.$this->table
                    .' set name=:name where id=:id';
            $stm = $this->conn->prepare($query);
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $stm->bindParam(':id', $this->id);
            $stm->bindParam(':name', $this->name);
            if($stm->execute()){
            return true;
            } else{
                return false;
            }
        }
        public function delete()
        {
            $query = 'delete from '.$this->table
                    .' where id=:id';
            $stm = $this->conn->prepare($query);
            $this->id=htmlspecialchars(strip_tags($this->id));
            $stm->bindParam(':id', $this->id);
            if($stm->execute()){
            return true;
            } else{
                return false;
            }
        }
    }
    
?>