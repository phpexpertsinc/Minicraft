<?php

class ServerManager {
  protected $servers = array();
  public function __construct($infos) {
    if (!empty($infos)) {
      foreach ($infos as $server_infos) {
        if (!empty($server_infos)) {
          $server = new Server($server_infos);
          $this->servers[$server->getId()] = $server;
        }
      }
    } else {
      Logger::log(__FILE__, 'Array empty for class constructor.');
    }
  }
  
  public function getServers() {
    foreach ($this->servers as $server) {
      $server->connect();
    }
    
    return $this->servers;
  }
  
  public function isPlaying($username) {
    $servers = $this->getServers();
    
    foreach ($servers as $server) {
      if ($server->isPlaying($username)) {
        return $server;
      }
    }
    
    return false;
  }
  
  public function getServer($id = 1) {
    $server = $this->servers[$id];
    $server->connect();
    return $server;
  }
}
