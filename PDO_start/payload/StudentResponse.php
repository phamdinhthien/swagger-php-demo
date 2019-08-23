<?php
   /**
   * @OA\Schema()
   */
class studentReadAllResponse{
    
   /**
   * @OA\Property(ref="#/components/schemas/Student/properties/id")
   */
   public $id;
      
   /**
   * @OA\Property(ref="#/components/schemas/Student/properties/name")
   */  
      public $name;
      
}

   /**
   * @OA\Schema()
   */
    class studentReadSigleResponse{
    
   /**
   * @OA\Property(ref="#/components/schemas/Student/properties/id")
   */
      public $id;
         
   /**
   * @OA\Property(ref="#/components/schemas/Student/properties/name")
   */  
         public $name;
        
  }