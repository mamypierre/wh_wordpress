angular.module('filterApp', ['ui.router', 'ngMessages', 'ngAria', 'ngSanitize'])
  .config(function ($interpolateProvider, $stateProvider, $urlServiceProvider) {
    // $interpolateProvider.startSymbol('[[').endSymbol(']]');

    var states = [{
      name: 'filter',
      url: '/filter',
      component: 'filterComponent',
      resolve: {
        posts: function (filterServices) {
          return filterServices.getPosts();
        },
        taxonomies: function () {
          return whOptions.taxonomies;
        }
      }
    }];
    // Enregistrer les status
    states.forEach(function (state) {
      $stateProvider.state(state);
    });
    $urlServiceProvider.rules.otherwise({
      state: 'filter'
    });

  })
  // Crée une service
  .service('filterServices', ['$http', '$q', function ($http, $q) {
    return {
      getPosts: function () {
        return whOptions.posts;
      }
    }
  }])
  // Le composant pour le filtre
  .component('filterComponent', {
    bindings: {
      posts: "<",
      taxonomies: "<"
    },
    templateUrl: whOptions.partials_url + '/filter-form.html',
    controller: function ($scope, $element, $attrs, filterServices) {
      var vm = this;
      $scope.postsList = [];
      $scope.taxonomies = [];
      $scope.search = {};
      this.$onInit = function() {
        $scope.postsList = _.clone(vm.posts);
        $scope.taxonomies = _.clone(vm.taxonomies);
      };
      
      $scope.$watch('search', function (value) {
        // Watch here...
      }, true);

      $scope.submitSearch = function (searchObject) {
        console.log(searchObject);
      };
    }
  })
  .component('searchFilterComponent', {
    templateUrl: whOptions.partials_url + '/search-filter-component.html',
    controller: function ($scope) {
      var vm = this;
      $scope.search = {};
      $scope.$watch('search', function(value) {
        vm.onSearch({search: value});
      }, true);
    },
    bindings: {
      taxonomie: '<',
      onSearch: '&'
    },
  })
  .component('postListComponent', {
    bindings: {
      'post': '<'
    },
    templateUrl: whOptions.partials_url + '/post-list-component.html',
    controller: function ($scope, $window) {
      var vm = this;
      vm.$onInit = function() {
        $scope.post = $window.angular.copy(vm.post);
      };
      
    
    }
  })