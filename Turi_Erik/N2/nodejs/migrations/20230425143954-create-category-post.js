'use strict';

const { DataTypes } = require('sequelize');

/** @type {import('sequelize-cli').Migration} */
module.exports = {
  async up (queryInterface, Sequelize) {
    /**
     * Add altering commands here.
     *
     * Example:
     * await queryInterface.createTable('users', { id: Sequelize.INTEGER });
     */
    await queryInterface.createTable('CategoryPost', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      CategoryId: {
        type: Sequelize.INTEGER,
        references: {
          model: 'Categories',
          key: 'id',
        },
        onDelete: 'cascade'
      },
      PostId: {
        type: Sequelize.INTEGER,
        references: {
          model: 'Posts',
          key: 'id',
        },
        onDelete: 'cascade'
      },
      createdAt:{
        type: Sequelize.DATE
      },
      updatedAt:{
        type: Sequelize.DATE
      },
    })

    await queryInterface.addConstraint("CategoryPost", {
      fields: ["CategoryId", "PostId"],
      type: "unique",
    });
  },

  async down (queryInterface, Sequelize) {
    /**
     * Add reverting commands here.
     *
     * Example:
     * await queryInterface.dropTable('users');
     */
  }
};
