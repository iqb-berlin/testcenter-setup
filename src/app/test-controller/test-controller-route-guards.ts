/* eslint-disable max-classes-per-file */

import { Injectable } from '@angular/core';
import {
  ActivatedRouteSnapshot, CanActivate, CanDeactivate, RouterStateSnapshot
} from '@angular/router';
import { Observable } from 'rxjs';
import { TestControllerComponent } from './test-controller.component';
import { TestControllerState, UnitNavigationTarget } from './test-controller.interfaces';
import { TestControllerService } from './test-controller.service';

@Injectable()
export class TestControllerDeactivateGuard implements CanDeactivate<TestControllerComponent> {
  constructor(
    private tcs: TestControllerService
  ) {
  }

  canDeactivate(): boolean {
    if (this.tcs.testMode.saveResponses) {
      const testStatus: TestControllerState = this.tcs.testStatus$.getValue();
      if ((testStatus === TestControllerState.RUNNING) || (testStatus === TestControllerState.PAUSED)) {
        if (this.tcs.bookletConfig.unit_menu !== 'OFF' || this.tcs.testMode.showUnitMenu) {
          this.tcs.setUnitNavigationRequest(UnitNavigationTarget.MENU);
        } else {
          this.tcs.setUnitNavigationRequest(UnitNavigationTarget.PAUSE);
        }
        return false;
      }
    }
    localStorage.removeItem(TestControllerComponent.localStorageTestKey);
    return true;
  }
}

@Injectable()
export class TestControllerErrorPausedActivateGuard implements CanActivate {
  constructor(
    private tcs: TestControllerService
  ) {
  }

  canActivate(): boolean {
    const testStatus: TestControllerState = this.tcs.testStatus$.getValue();
    return (testStatus !== TestControllerState.ERROR) &&
      (testStatus !== TestControllerState.FINISHED) &&
      (testStatus !== TestControllerState.PAUSED);
  }
}

export const testControllerRouteGuards = [TestControllerDeactivateGuard, TestControllerErrorPausedActivateGuard];
