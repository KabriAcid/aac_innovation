import React from 'react';
import SupportChatWidget from './components/ui/SupportChatWidget';

function App() {
  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between h-16">
            <div className="flex items-center">
              <h1 className="text-2xl font-bold text-gray-900">AAC Innovation</h1>
            </div>
            <nav className="hidden md:flex space-x-8">
              <a href="#" className="text-gray-600 hover:text-gray-900 transition-colors">Products</a>
              <a href="#" className="text-gray-600 hover:text-gray-900 transition-colors">Solutions</a>
              <a href="#" className="text-gray-600 hover:text-gray-900 transition-colors">Support</a>
              <a href="#" className="text-gray-600 hover:text-gray-900 transition-colors">About</a>
            </nav>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="text-center">
          <h2 className="text-4xl font-bold text-gray-900 mb-4">
            Advancing Communication Technology
          </h2>
          <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Empowering individuals with innovative Augmentative and Alternative Communication solutions. 
            Discover how our platform can transform the way people connect and communicate.
          </p>
        </div>

        <div className="grid md:grid-cols-3 gap-8 mt-16">
          <div className="bg-white p-8 rounded-lg shadow-sm border">
            <h3 className="text-xl font-semibold text-gray-900 mb-4">Intuitive Design</h3>
            <p className="text-gray-600">
              Our user-friendly interfaces are designed with accessibility in mind, ensuring everyone can communicate effectively.
            </p>
          </div>
          
          <div className="bg-white p-8 rounded-lg shadow-sm border">
            <h3 className="text-xl font-semibold text-gray-900 mb-4">Cross-Platform</h3>
            <p className="text-gray-600">
              Access your communication tools on any device - tablets, phones, computers, or dedicated AAC devices.
            </p>
          </div>
          
          <div className="bg-white p-8 rounded-lg shadow-sm border">
            <h3 className="text-xl font-semibold text-gray-900 mb-4">24/7 Support</h3>
            <p className="text-gray-600">
              Get help whenever you need it with our comprehensive support system and community resources.
            </p>
          </div>
        </div>

        <div className="mt-16 text-center">
          <p className="text-lg text-gray-600 mb-8">
            Need help getting started? Try our decision-tree support chat in the bottom-right corner! 
            It will guide you through different topics with follow-up questions based on your needs.
          </p>
        </div>
      </main>

      {/* Footer */}
      <footer className="bg-gray-900 text-white mt-24">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div className="grid md:grid-cols-4 gap-8">
            <div>
              <h4 className="text-lg font-semibold mb-4">AAC Innovation</h4>
              <p className="text-gray-400">
                Leading the future of communication technology for everyone.
              </p>
            </div>
            <div>
              <h4 className="text-lg font-semibold mb-4">Products</h4>
              <ul className="space-y-2 text-gray-400">
                <li><a href="#" className="hover:text-white transition-colors">Communication Apps</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Device Integration</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Custom Solutions</a></li>
              </ul>
            </div>
            <div>
              <h4 className="text-lg font-semibold mb-4">Support</h4>
              <ul className="space-y-2 text-gray-400">
                <li><a href="#" className="hover:text-white transition-colors">Documentation</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Training</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Contact Us</a></li>
              </ul>
            </div>
            <div>
              <h4 className="text-lg font-semibold mb-4">Company</h4>
              <ul className="space-y-2 text-gray-400">
                <li><a href="#" className="hover:text-white transition-colors">About</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Careers</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Privacy</a></li>
              </ul>
            </div>
          </div>
          <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 AAC Innovation. All rights reserved.</p>
          </div>
        </div>
      </footer>

      {/* Support Chat Widget */}
      <SupportChatWidget />
    </div>
  );
}

export default App;