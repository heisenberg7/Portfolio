<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29/03/2016
 * Time: 17:40
 */

namespace control;

class ProjectManager
    {
    private $_db;

    function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(Project $project)
    {
        $req = $this->_db_prepare('INSERT INTO project SET name = :name, description = :description, details = :details');

        $req->bindValue(':name', $project->name());
        $req->bindValue(':description',$project->description());
        $req->bindValue(':details', $project->details);

        $req->execute();
    }

    public function delete(Project $project)
    {
        $this->_db->exec('DELETE FROM project WHERE id = '.$project->id());
    }

    public function get($id){
        $id = (int) $id;

        $req = $this->_db->query('SELECT id, name, description, details FROM project WHERE id = .$id');
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return new Project($data);
    }

    function getList()
    {
        $projects = array();

        $req = $this->_db->query('SELECT id, name, description, details FROM project ORDER BY name');

        while ($data = $req->fetch(PDO::ASSOC))
        {
            $data[] = new Project($data);
        }

        return $projects;
    }

    function update(Project $project)
    {
        $req = $this->_db->prepare('UPDATE project SET name = :name, description = :description, details = :details WHERE id = :id');

        $req->bindValue(':name', $project->name());
        $req->bindValue(':description',$project->description());
        $req->bindValue(':details', $project->details());
        $req->bindValue(':id', $project->id(), PDO::PARAM_INT);

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