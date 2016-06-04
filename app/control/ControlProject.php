<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29/03/2016
 * Time: 17:40
 */

namespace control;

use config\Db;
use model\Project;

/**
 * Class ControlProject
 * @package control
 */
class ControlProject
    {
    /** @var \PDO */
    private $db;

    /**
     * @param Db $db
     */
    public function __construct(Db $db)
    {
        if (!$db) throw new \InvalidArgumentException("First argument is expected to be a valid PDO instance, NULL given");
        $this->db = $db->getPDOInstance();
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function addProject($project)
    {
        $req = $this->db->prepare('INSERT INTO project values (null ,:name, :description, :details');
        $req->bindValue(':name', $project->getName());
        $req->bindValue(':description',$project->getDescription());
        $req->bindValue(':details', $project->getDetails());
        $req->execute();
        return $this->db->lastInsertId();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProject($id)
    {
        $req = $this->db->prepare('DELETE FROM project WHERE id=:id');
        $req->bindValue(':id', $id);
        return $req->execute();
    }

    /**
     * @return array|bool
     */
    public function getProject()
    {
        $req = $this->db->prepare('SELECT * FROM project');
        $req->execute();
        $projects = false;
        while($result = $req->fetch()){
            $project = new Project($result);
            $projects[] = $project;
        }
        return $projects;
    }

    public function getProjectId($id)
    {
        $req = $this->db->prepare('SELECT * FROM project where id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
        $projects = false;
        /*if($result = $req->fetch()){
            $project = new Project($result);
            $projects = $project;
        }*/
        return $projects;
    }

    /**
     * @param $project
     */
    function update($project)
    {
        $req = $this->db->prepare('UPDATE project SET name = :name, description = :description, details = :details WHERE id = :id');
        $req->bindValue(':name', $project->getName());
        $req->bindValue(':description',$project->getDescription());
        $req->bindValue(':details', $project->getDetails());
        $req->execute();
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

}