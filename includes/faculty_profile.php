<?php
function getFacultyProfile($faculty) {
    $name = strtolower($faculty['name'] ?? '');
    $code = strtolower($faculty['code'] ?? '');

    $default = [
        'summary' => 'The faculty combines strong academic theory with practical training to prepare students for successful careers and lifelong learning.',
        'focus' => 'Student-centered teaching, applied research, and industry engagement.',
        'highlights' => [
            'Experienced and qualified academic staff',
            'Modern learning facilities and laboratories',
            'Practical internships and fieldwork opportunities',
            'Career guidance and professional support'
        ],
        'programs' => ['Undergraduate studies', 'Postgraduate studies', 'Professional training'],
        'careers' => ['Leadership and management roles', 'Professional practice', 'Research and innovation'],
        'admission' => 'Applicants should meet the university admission requirements and provide the requested academic documents.'
    ];

    if (strpos($name, 'comput') !== false || strpos($name, 'inform') !== false || strpos($name, 'it') !== false || strpos($code, 'cs') !== false || strpos($code, 'it') !== false) {
        return [
            'summary' => 'The Faculty of Computing and Informatics equips students with digital, analytical, and problem-solving skills for today’s technology-driven world.',
            'focus' => 'Software development, data systems, innovation, and practical technology training.',
            'highlights' => [
                'Hands-on coding and software projects',
                'Modern computer laboratories and digital tools',
                'Industry-aligned practical training',
                'Strong support for innovation and entrepreneurship'
            ],
            'programs' => ['Computer Science', 'Information Technology', 'Software Engineering', 'Data Science'],
            'careers' => ['Software developer', 'Systems analyst', 'IT support specialist', 'Data analyst'],
            'admission' => 'Applicants should have a strong academic background in mathematics and sciences and meet the university entry criteria.'
        ];
    }

    if (strpos($name, 'business') !== false || strpos($name, 'manage') !== false || strpos($name, 'commerce') !== false || strpos($code, 'bm') !== false) {
        return [
            'summary' => 'The Faculty of Business and Management develops responsible leaders with skills in strategy, finance, entrepreneurship, and organizational growth.',
            'focus' => 'Business leadership, financial literacy, and practical enterprise training.',
            'highlights' => [
                'Entrepreneurship and innovation projects',
                'Finance, marketing, and management training',
                'Exposure to business case studies and internships',
                'Strong emphasis on leadership and ethics'
            ],
            'programs' => ['Business Administration', 'Marketing', 'Accounting', 'Human Resource Management'],
            'careers' => ['Business manager', 'Accountant', 'Marketing executive', 'HR specialist'],
            'admission' => 'Applicants should meet the general admission requirements and demonstrate good academic performance in relevant subjects.'
        ];
    }

    if (strpos($name, 'educ') !== false || strpos($name, 'social') !== false || strpos($code, 'edu') !== false) {
        return [
            'summary' => 'The Faculty of Education and Social Sciences prepares educators, researchers, and community leaders who create positive impact in society.',
            'focus' => 'Teaching excellence, social development, and community engagement.',
            'highlights' => [
                'Practical teaching and field experience',
                'Community outreach and service learning',
                'Research opportunities in education and society',
                'Supportive mentorship and professional training'
            ],
            'programs' => ['Education', 'Social Work', 'Development Studies', 'Guidance and Counseling'],
            'careers' => ['Teacher', 'Education officer', 'Social worker', 'Community development specialist'],
            'admission' => 'Applicants should demonstrate strong academic readiness and a commitment to service and professional growth.'
        ];
    }

    if (strpos($name, 'health') !== false || strpos($name, 'med') !== false || strpos($code, 'hs') !== false) {
        return [
            'summary' => 'The Faculty of Health Sciences provides rigorous training that combines scientific knowledge, clinical practice, and compassionate care.',
            'focus' => 'Patient-centered practice, public health, and evidence-based care.',
            'highlights' => [
                'Modern clinical and practical training',
                'Hands-on exposure to health systems',
                'Research and public health focus',
                'Professional ethics and safety standards'
            ],
            'programs' => ['Nursing', 'Public Health', 'Medical Laboratory Sciences', 'Health Administration'],
            'careers' => ['Clinical practitioner', 'Public health officer', 'Laboratory scientist', 'Health administrator'],
            'admission' => 'Applicants must satisfy the health sciences admission requirements and provide the necessary supporting documents.'
        ];
    }

    return $default;
}
