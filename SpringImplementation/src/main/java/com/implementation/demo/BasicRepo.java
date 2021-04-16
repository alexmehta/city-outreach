package com.implementation.demo;

import org.springframework.data.jpa.repository.JpaRepository;

public interface BasicRepo extends JpaRepository<EntityEvent, Long> {

}
