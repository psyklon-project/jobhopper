<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Application;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		User::factory()->create([
			'name' => 'Admin User',
			'email' => 'admin@example.com',
			'password' => bcrypt('admin'),
			'role' => 'admin',
		]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
			'password' => bcrypt('user'),
			'role' => 'user',
        ]);

		Position::factory()->create([
			'title' => 'Front-End Developer',
			'description' => 'The Front-End Developer is responsible for building and maintaining user-facing web applications. They work closely with designers and back-end engineers to implement responsive, accessible, and high-performance interfaces. Proficiency in modern JavaScript frameworks (such as React, Vue, or Svelte), HTML5, and CSS3 is required. Experience with RESTful APIs, version control (Git), and front-end build tools (Webpack, Vite) is a plus.',
			'max_applicants' => 10,
		]);

		Position::factory()->create([
			'title' => 'DevOps Engineer',
			'description' => 'The DevOps Engineer manages the company\'s cloud infrastructure and CI/CD pipelines to ensure reliable and efficient software delivery. They are responsible for system automation, monitoring, and security, as well as collaborating with development teams to streamline deployment processes. Experience with Docker, Kubernetes, and cloud platforms (AWS, Azure, or GCP) is essential.',
			'max_applicants' => 5,
		]);

		Position::factory()->create([
			'title' => 'Machine Learning Engineer',
			'description' => 'The Machine Learning Engineer develops, trains, and deploys machine learning models for data-driven applications. They collaborate with data scientists to design scalable ML solutions and integrate them into production systems. Proficiency in Python, TensorFlow, or PyTorch, and experience with data preprocessing, model evaluation, and cloud ML services are expected.',
			'max_applicants' => 1,
		]);

		Application::factory()->create([
			'user_id' => 2,
			'position_id' => 1,
		]);

		Application::factory()->create([
			'user_id' => 2,
			'position_id' => 3,
		]);
	}
}
