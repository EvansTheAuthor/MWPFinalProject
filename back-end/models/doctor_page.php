<?php
class doctor_page{
    public $id;
    public $docname;
    public $specialization;

    public function __construct($id, $docname, $specialization) {
        $this->id = $id;
        $this->docname = $docname;
        $this->specialization = $specialization;
    }

    public function toArray(){
        return [
            "id"=> $this->id,
            "nama"=> $this->docname,
            "spesialis"=> $this->specialization
        ];
    }
}
?>