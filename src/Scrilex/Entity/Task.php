<?php

namespace Scrilex\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Scrilex\Entity\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     */
    protected $project;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     */
    protected $user;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $pos;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $col;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $severity;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $content;
    
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="task")
     */
    protected $histories;
    
    public function getId() { return $this->id; }
    public function getProject() { return $this->project; }
    public function getUser() { return $this->user; }
    public function getPos() { return $this->pos; }
    public function getCol() { return $this->col; }
    public function getSeverity() { return $this->severity; }
    public function getContent() { return $this->content; }
    
    public function setId($id) { $this->id = $id; return $this; }
    public function setProject($project) { $this->project = $project; return $this; }
    public function setUser($user) { $this->user = $user; return $this; }
    public function setPos($pos) { $this->pos = $pos; return $this; }
    public function setCol($col) { $this->col = $col; return $this; }
    public function setSeverity($severity) { $this->severity = $severity; return $this; }
    public function setContent($content) { $this->content = $content; return $this; }
    
    public function toArray()
    {
        return array(
            'id' => $this->id,
            'project_id' => $this->getProject()->getId(),
            'user_id' => $this->getUser()->getId(),
            'pos' => $this->pos,
            'col' => $this->col,
            'severity' => $this->severity,
            'content' => $this->content,
        );
    }
    
    public function fromArray($array)
    {
        $this->setUser($app['db.orm.em']->getRepository('Scrilex\Entity\User')->find($array['user_id']))
            ->setPos($array['pos'])
            ->setCol($array['col'])
            ->setSeverity($array['severity'])
            ->setContent($array['content']);
    }
}