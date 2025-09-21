import { TeamMember } from '@/types';

export const teamMembers: TeamMember[] = [
  {
    id: 'john-doe',
    name: 'John Doe',
    role: 'Chief Technology Officer',
    expertise: ['Cloud Architecture', 'DevOps', 'System Design'],
    avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face'
  },
  {
    id: 'jane-smith',
    name: 'Jane Smith',
    role: 'Cybersecurity Lead',
    expertise: ['Penetration Testing', 'Security Consulting', 'Compliance'],
    avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop&crop=face'
  },
  {
    id: 'mike-johnson',
    name: 'Mike Johnson',
    role: 'AI/ML Engineer',
    expertise: ['Machine Learning', 'Natural Language Processing', 'Computer Vision'],
    avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face'
  },
  {
    id: 'sarah-wilson',
    name: 'Sarah Wilson',
    role: 'Fintech Specialist',
    expertise: ['Payment Systems', 'Blockchain', 'Financial APIs'],
    avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face'
  },
  {
    id: 'david-brown',
    name: 'David Brown',
    role: 'IoT Solutions Architect',
    expertise: ['IoT Development', 'Edge Computing', 'Sensor Networks'],
    avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=face'
  },
  {
    id: 'lisa-garcia',
    name: 'Lisa Garcia',
    role: 'Strategic Consultant',
    expertise: ['Digital Transformation', 'Business Strategy', 'Change Management'],
    avatar: 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=400&h=400&fit=crop&crop=face'
  }
];

export const getTeamMemberById = (id: string) => {
  return teamMembers.find(member => member.id === id);
};

export const getTeamMembersByExpertise = (expertise: string) => {
  return teamMembers.filter(member => 
    member.expertise.some(exp => 
      exp.toLowerCase().includes(expertise.toLowerCase())
    )
  );
};