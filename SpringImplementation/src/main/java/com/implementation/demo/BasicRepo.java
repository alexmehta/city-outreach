package com.implementation.demo;

import org.springframework.data.jpa.repository.JpaRepository;

import javax.transaction.Transactional;

public interface BasicRepo extends JpaRepository<EntityEvent, Long> {

}
